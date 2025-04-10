<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


use Illuminate\Support\Facades\File;


class AdminController extends Controller
{
    public function view_category()
    {
        $categories = Category::all();
        return view('admin.category', compact('categories'));
    }

    public function add_category(Request $request)
    {
        $category = new Category;
        $category->category_name = $request->category_name;
        $category->save();
        
        return redirect()->back()->with('message', 'Category Added Successfully');
    }

    public function delete_category($id)
    {
    \DB::transaction(function () use ($id) {
        // 1. Find the category
        $category = Category::findOrFail($id);
        
        // 2. Get all products in this category
        $products = Product::where('category_id', $id)->get();
        
        // 3. Delete each product and its dependencies
        foreach ($products as $product) {
            // First delete all order items for this product
            \DB::table('order_items')->where('product_id', $product->id)->delete();
            
            // Then delete the product image
            $imagePath = public_path('product/'.$product->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            
            // Finally delete the product
            $product->delete();
        }
        
        // 4. Now delete the category
        $category->delete();
    });
    
    return redirect()->back()->with('message', 'Category and all associated products deleted successfully');
    }

    public function all_product()
    {
        $products = Product::paginate(9); // Show 9 products per page
        return view('home.products', compact('products'));
    }

    public function view_product()
    {
        $categories = Category::all();
        $products = Product::all();
        return view('admin.product', compact('categories', 'products'));
    }

    public function add_product(Request $request)
    {
    $validated = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'quantity' => 'required|integer',
        'discount_price' => 'nullable|numeric',
        'category_id' => 'required|exists:categories,id',
        'image' => 'required|image'
    ]);

    $product = new Product();
    
    // Get category name
    $category = Category::findOrFail($request->category_id);

    $product->fill([
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
        'quantity' => $request->quantity,
        'discount_price' => $request->discount_price,
        'category_id' => $request->category_id,
        'category' => $category->category_name // Set both fields
    ]);

    // Handle image
    $imageName = time().'.'.$request->image->extension();  
    $request->image->move(public_path('product'), $imageName);
    $product->image = $imageName;

    $product->save();

    return redirect()->back()->with('message', 'Product Added Successfully');
    }

    public function show_product()
    {
        $product = Product::all(); 
        $category = Category::all(); 
        return view('admin.show_product', compact('product', 'category'));
    }

    public function delete_product($id)
    {
        $product = Product::find($id);

        $image_path = public_path('product/' . $product->image);
        if (File::exists($image_path)) {
            File::delete($image_path);
        }

        $product->delete();
        
        return redirect()->back()->with('message', 'Product Deleted Successfully');
    }

    public function edit_product($id)
    {
        $product = Product::find($id);
        $categories = Category::all();
        
        return view('admin.edit_product', compact('product', 'categories'));
    }

    public function updateProduct(Request $request, $id)
    {
    // Debugging - check what's coming in
    \Log::debug('Update Product Request:', $request->all());
    
    $validated = $request->validate([
        'title' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'discount_price' => 'nullable|numeric',
        'category_id' => 'required|exists:categories,id',
        'quantity' => 'required|integer',
        'image' => 'nullable|image'
    ]);

    $product = Product::findOrFail($id);
    $category = Category::findOrFail($request->category_id);

    \Log::debug('Before Update:', $product->toArray());

    $product->update([
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
        'discount_price' => $request->discount_price,
        'quantity' => $request->quantity,
        'category_id' => $request->category_id,
        'category' => $category->category_name
    ]);

    if ($request->hasFile('image')) {
        \Log::debug('Updating image...');
        $oldImage = public_path('product/'.$product->image);
        if (file_exists($oldImage)) {
            unlink($oldImage);
        }
        
        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('product'), $imageName);
        $product->image = $imageName;
        $product->save();
    }

    \Log::debug('After Update:', $product->fresh()->toArray());
    
    return redirect()->back()->with('message', 'Product updated successfully');
    }

    public function index()
    {
        $total_products = Product::count();
        $total_categories = Category::count();
        
        return view('admin.home', compact('total_products', 'total_categories'));
    }

    public function dashboard()
    {
        $total_products = Product::count();
        $total_orders = Order::count();
        $total_users = User::where('usertype', 'user')->count(); // Assuming you have a 'usertype' column
        $total_revenue = Order::where('payment_status', 'paid')->sum('total_amount');
        $orders = Order::latest()->paginate(10); // For the recent orders table
        
        return view('admin.dashboard', compact(
            'total_products',
            'total_orders',
            'total_users',
            'total_revenue',
            'orders'
        ));
    }

    public function show_category()
    {
        $data = Category::all();
        return view('admin.show_category', compact('data'));
    }

    public function updateOrderStatus(Request $request)
{
    $validated = $request->validate([
        'order_id' => 'required|exists:orders,id',
        'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
    ]);

    $order = Order::findOrFail($validated['order_id']);
    $oldStatus = $order->status;
    
    // Only proceed if status is actually changing
    if ($oldStatus !== $validated['status']) {
        
        // Update payment_status based on new status
        if ($validated['status'] === 'delivered') {
            $order->payment_status = 'paid';
        } 
        elseif ($validated['status'] === 'cancelled') {
            $order->payment_status = 'cancelled';
            // No cancelled_at column, so we skip that
        }
        
        // If changing FROM delivered/cancelled to another status
        if (in_array($oldStatus, ['delivered', 'cancelled']) && 
            !in_array($validated['status'], ['delivered', 'cancelled'])) {
            $order->payment_status = 'pending'; // Reset to default
        }
        
        $order->status = $validated['status'];
        $order->save();
    }

    return back()->with('success', 'Order status updated successfully');
}
    
}