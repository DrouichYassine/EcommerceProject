<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::paginate(9);
        return view('home.userpage', compact('products'));
    }
    
    public function redirect()
    {
        $usertype = Auth::user()->usertype;
        
        if($usertype == '1')
        {
            $total_product = Product::all()->count();
            $total_orders = Order::all()->count();
            $total_users = User::where('usertype', '0')->count();
            $orders = Order::orderBy('created_at', 'desc')->paginate(10);
            $total_revenue = Order::sum('total_amount');
            
            return view('admin.home', compact('total_product', 'total_orders', 'total_users', 'orders', 'total_revenue'));
        }
        else
        {
            $product = Product::paginate(9);
            return view('home.userpage', compact('product'));
        }
    }
    
    public function all_products()
    {
        $products = Product::paginate(9);
        return view('home.products', compact('products'));
    }
    
    public function product_details($id)
    {
        $product = Product::findOrFail($id);
        return view('home.product_details', compact('product'));
    }
    
    public function add_cart(Request $request, $id)
    {
        if(Auth::id())
        {
            $user = Auth::user();
            $product = Product::findOrFail($id);
            
            $cart = new Cart;
            
            $cart->name = $user->name;
            $cart->email = $user->email;
            $cart->phone = $user->phone ?? 0; // Default to 0 if phone is null or empty
            $cart->address = $user->address ?? '';
            $cart->user_id = $user->id;
            
            $cart->product_title = $product->title;
            $cart->product_id = $product->id;
            $cart->price = $product->price;
            $cart->image = $product->image;
            $cart->quantity = $request->quantity ?? 1;
            
            $cart->save();
            
            return redirect()->back()->with('message', 'Product Added to Cart Successfully');
        }
        else
        {
            return redirect('login');
        }
    }
    
    public function show_cart()
    {
        if(Auth::id())
        {
            $id = Auth::user()->id;
            $cart = Cart::where('user_id', $id)->get();
            return view('home.showcart', compact('cart'));
        }
        else
        {
            // Store intended URL in session
            session(['url.intended' => url('/show_cart')]);
            
            return redirect()->route('login');
        }
    }
    
    public function remove_cart($id)
    {
        $cart = Cart::find($id);
        
        if($cart && $cart->user_id == Auth::id()) {
            $cart->delete();
        }
        
        return redirect()->back()->with('message', 'Item removed from cart successfully!');
    }
    
    public function account()
    {
        $user = Auth::user();
        $orders = []; // Replace with actual orders if you have them
        return view('home.account', compact('user', 'orders'));
    }
    
    public function checkout()
    {
        $userId = Auth::id();
        $cart = Cart::where('user_id', $userId)->get();
        
        return view('home.checkout', compact('cart'));
    }

    public function placeOrder(Request $request)
    {
        // Validate the request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zip' => 'required|string|max:20',
            'payment_method' => 'required|string',
            'terms' => 'required'
        ]);

        // Get cart items
        $user_id = Auth::id();
        $cart_items = Cart::where('user_id', $user_id)->get();
        
        if ($cart_items->count() == 0) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        // Calculate total
        $total_amount = 0;
        foreach ($cart_items as $item) {
            $total_amount += $item->price;
        }

        // Create order
        $order = new Order();
        $order->user_id = $user_id;
        $order->first_name = $request->first_name;
        $order->last_name = $request->last_name;
        $order->email = $request->email;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->city = $request->city;
        $order->state = $request->state;
        $order->zip = $request->zip;
        $order->payment_method = 'cash_on_delivery';
        $order->payment_status = 'pending';
        $order->order_status = 'processing';
        $order->total_amount = $total_amount;
        $order->save();

        // Create order items
        foreach ($cart_items as $item) {
            $order_item = new OrderItem();
            $order_item->order_id = $order->id;
            $order_item->product_id = $item->product_id;
            $order_item->product_title = $item->product_title;
            $order_item->price = $item->price;
            $order_item->quantity = $item->quantity;
            $order_item->save();
        }

        // Clear the cart
        Cart::where('user_id', $user_id)->delete();

        // Redirect to order complete page with order details
        return view('home.order_complete', compact('order'));
    }
}