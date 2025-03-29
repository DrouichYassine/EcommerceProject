<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Category;

class AdminController extends Controller
{
    public function view_category(){
        $data=Category::all();
        return view('admin.category',compact('data'));
    }
    public function add_category(request $request){
        $data = new Category;
        $data->category_name = $request->category_name;
        $data->save();
        return redirect()->back()->with('message', 'Category Added Successfully');
}
    public function delete_category($id){
        $data = Category::find($id);
        $data->delete();
        return redirect()->back()->with('message', 'Category Deleted Successfully');
    }
}