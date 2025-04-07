<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Exception\CardException;

class CheckoutController extends Controller
{
    public function showCheckout()
    {
        $user = Auth::user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
        
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.show')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        return view('home.checkout', [
            'cartItems' => $cartItems,
            'total' => $total,
            'user' => $user,
            'stripeKey' => config('services.stripe.key')
        ]);
    }

    public function placeOrder(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip_code' => 'required|string|max:20',
            'payment_method' => 'required|in:cash_on_delivery,card',
            'terms' => 'accepted',
            'stripeToken' => 'required_if:payment_method,card'
        ]);

        DB::beginTransaction();

        try {
            $user = Auth::user();
            $cartItems = Cart::where('user_id', $user->id)->with('product')->get();
            $total = $cartItems->sum(function ($item) {
                return $item->product->price * $item->quantity;
            });

            // Process Stripe payment if card selected
            $stripeChargeId = null;
            $paymentStatus = 'pending';
            
            if ($request->payment_method === 'card') {
                Stripe::setApiKey(config('services.stripe.secret'));
                
                $charge = Charge::create([
                    'amount' => $total * 100, // in cents
                    'currency' => 'usd',
                    'source' => $request->stripeToken,
                    'description' => 'Order from ' . $request->email,
                ]);
                
                $stripeChargeId = $charge->id;
                $paymentStatus = 'paid';
            }

            // Create order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(uniqid()),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'state' => $request->state,
                'zip_code' => $request->zip_code,
                'payment_method' => $request->payment_method,
                'payment_status' => $paymentStatus,
                'stripe_charge_id' => $stripeChargeId,
                'status' => 'processing',
                'total_amount' => $total,
            ]);

            // Create order items
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                ]);
            }

            // Clear cart
            Cart::where('user_id', $user->id)->delete();

            DB::commit();

            return redirect()->route('order.success', $order);

        } catch (CardException $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Order failed: ' . $e->getMessage());
        }
    }

    public function orderSuccess(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        return view('home.order-success', compact('order'));
    }
}