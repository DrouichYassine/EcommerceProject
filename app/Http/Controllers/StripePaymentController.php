<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Exception\CardException;
use Illuminate\Support\Facades\Auth;

class StripePaymentController extends Controller
{
    public function processPayment(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
            'stripeToken' => 'required'
        ]);

        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            // Create a customer
            $customer = Customer::create([
                'email' => Auth::user()->email,
                'source' => $request->stripeToken
            ]);

            // Create the charge
            $charge = Charge::create([
                'customer' => $customer->id,
                'amount' => $request->amount * 100, // amount in cents
                'currency' => 'usd',
                'description' => 'Payment for order'
            ]);

            // Return success response to frontend
            return response()->json([
                'success' => true,
                'charge_id' => $charge->id
            ]);

        } catch (CardException $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 422);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'An error occurred: '.$e->getMessage()
            ], 500);
        }
    }

    public function cancel()
    {
        return view('payment.cancel');
    }
}