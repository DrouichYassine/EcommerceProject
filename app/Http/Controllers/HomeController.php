<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


use App\Models\User;

class HomeController extends Controller
{
    public function index(){
        return view('home.userpage');
    }
    public function redirect(){
        if(Auth::check()) {
            $usertype = Auth::user()->usertype;
            if($usertype=='1'){
                return view('admin.home');
            }else{
                return view('home.userpage');
            }
        } else {
            // Redirect unauthenticated users to login page
            return redirect()->route('login');
        }
    }
    
}