<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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

    public function search(Request $request)
    {
        $query = $request->input('query');
        
        // Search for products that match the query
        $products = Product::where('title', 'LIKE', "%$query%")
                          ->orWhere('description', 'LIKE', "%$query%")
                          ->orWhere('category', 'LIKE', "%$query%")
                          ->get();
        
        // If only one product is found, redirect to its detail page
        if ($products->count() == 1) {
            return redirect()->route('product.details', $products->first()->id);
        }
        
        // Otherwise show search results
        return view('home.search_results', compact('products', 'query'));
    }

    public function search_product(Request $request)
    {
        $search = $request->search;
        
        // Search for products that match the search query
        $product = Product::where('title', 'LIKE', "%$search%")
                          ->orWhere('description', 'LIKE', "%$search%")
                          ->orWhere('category', 'LIKE', "%$search%")
                          ->first();
        
        // If product is found, redirect to product details
        if ($product) {
            return redirect('product_details/' . $product->id);
        }
        
        // If no product is found, show the not found page
        return view('home.product_not_found', compact('search'));
    }
}