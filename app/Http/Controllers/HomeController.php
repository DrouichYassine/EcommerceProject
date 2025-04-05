<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;

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
            // Get statistics for admin dashboard
            $total_products = Product::count();
            $total_orders = 0; // Replace with actual order count when you have an Order model
            $total_customers = User::where('usertype', '0')->count();
            $total_revenue = 0; // Replace with actual revenue calculation when you have order data
            
            return view('admin.home', compact(
                'total_products',
                'total_orders',
                'total_customers',
                'total_revenue'
            ));
        }
        else
        {
            $products = Product::paginate(9);
            return view('home.userpage', compact('products'));
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
        $userId = Auth::id();
        
        // Validate the request
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'zipCode' => 'required|string|max:20',
            'paymentMethod' => 'required|string|max:50',
            'agreeTerms' => 'required',
        ]);
        
        // Create order here
        // You would typically save the order details to your database
        
        // For demonstration purposes, we'll just show a success message
        
        // Clear the cart after successful order
        Cart::where('user_id', $userId)->delete();
        
        return redirect()->route('home')->with('message', 'Order placed successfully!');
    }
}