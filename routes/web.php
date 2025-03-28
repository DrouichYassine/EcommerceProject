<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\AdminController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

route::get('/',[HomeController::class, 'index']); 


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
route::get('/redirect',[HomeController::class, 'redirect']); 
Route::get('/view_category',[AdminController::class, 'view_category'])->name('view_category');
Route::post('/add_category',[AdminController::class, 'add_category'])->name('add_category');
Route::delete('/delete_category/{id}',[AdminController::class, 'delete_category'])->name('delete_category');


