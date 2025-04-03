<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
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
        $category = Category::find($id);
        $category->delete();
        
        return redirect()->back()->with('message', 'Category Deleted Successfully');
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
        $product = new Product;

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->discount_price = $request->discount_price;
        $product->category = $request->category;

        $image = $request->image;
        $imagename = time() . '.' . $image->getClientOriginalExtension();
        $request->image->move('product', $imagename);

        $product->image = $imagename;

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

    public function update_product(Request $request, $id)
    {
        $product = Product::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->quantity = $request->quantity;
        $product->category = $request->category;

        if ($request->hasFile('image')) {
            $image_path = public_path('product/' . $product->image);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }

            $image = $request->image;
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }

        $product->save();

        return redirect()->back()->with('message', 'Product Updated Successfully');
    }

    public function update_product_confirm(Request $request, $id)
    {
        $product = Product::find($id);

        $product->title = $request->title;
        $product->description = $request->description;
        $product->price = $request->price;
        $product->discount_price = $request->dis_price;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
        $image = $request->image;
        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('product', $imagename);
            $product->image = $imagename;
        }
        $product->save();

        return redirect()->back()->with('message', 'Product Updated successfully');
    }

    public function index()
    {
        $total_products = Product::count();
        $total_categories = Category::count();
        
        return view('admin.home', compact('total_products', 'total_categories'));
    }

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function show_category()
    {
        $data = Category::all();
        return view('admin.show_category', compact('data'));
    }
}