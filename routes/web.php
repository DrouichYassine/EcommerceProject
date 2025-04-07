<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\UpdateController;
use Laravel\Fortify\Http\Controllers\AuthenticatedSessionController;
use Laravel\Fortify\Http\Controllers\RegisteredUserController;

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

// Home page route
Route::get('/',[HomeController::class, 'index'])->name('home');

// Authentication routes (manually adding these if Fortify/Jetstream isn't working correctly)
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

// POST routes for authentication
Route::post('/login', [AuthenticatedSessionController::class, 'store'])->middleware(['guest']);
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout')->middleware('auth');
Route::post('/register', [RegisteredUserController::class, 'store'])->middleware(['guest']);

// Dashboard route
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// User account related routes
Route::middleware(['auth'])->group(function() {
    Route::get('/redirect', [HomeController::class, 'redirect'])->name('redirect');
    Route::get('/account', [HomeController::class, 'account'])->name('account');
    
    // Cart routes
    Route::get('/show_cart', [HomeController::class, 'show_cart'])->name('cart.show');
    Route::get('/remove_cart/{id}', [HomeController::class, 'remove_cart'])->name('cart.remove');
    
    // Order routes
    Route::get('/orders', [HomeController::class, 'orders'])->name('orders');
    Route::get('/order/{id}', [HomeController::class, 'orderDetails'])->name('order.details');
    
    // Checkout routes
    Route::get('/checkout', [CheckoutController::class, 'showCheckout'])->name('checkout');
    
    // This handles the form submission
    Route::post('/place-order', [CheckoutController::class, 'placeOrder'])->name('place.order');
    
    // Add this new route for Stripe payment processing
    Route::post('/stripe/payment', [StripePaymentController::class, 'processPayment'])->name('stripe.payment');
    
    // Success/Cancel routes
    Route::get('/order-success/{order}', [CheckoutController::class, 'orderSuccess'])->name('order.success');
    Route::get('/payment/cancel', [StripePaymentController::class, 'cancel'])->name('payment.cancel');
    
});


// Admin routes with role checking
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function() {
    // Admin profile routes
    Route::delete('/profile', [AdminController::class, 'destroyProfile'])->name('admin.profile.destroy');
    
    // Category management routes - improved RESTful structure
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/category/create', [AdminController::class, 'createCategory'])->name('admin.category.create');
    Route::post('/category', [AdminController::class, 'storeCategory'])->name('admin.category.store');
    Route::get('/category/{id}', [AdminController::class, 'showCategory'])->name('admin.category.show');
    Route::get('/category/{id}/edit', [AdminController::class, 'editCategory'])->name('admin.category.edit');
    Route::put('/category/{id}', [AdminController::class, 'updateCategory'])->name('admin.category.update');
    Route::delete('/category/{id}', [AdminController::class, 'destroyCategory'])->name('admin.category.destroy');
    
    // Product management routes - improved RESTful structure
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/product/create', [AdminController::class, 'createProduct'])->name('admin.product.create');
    Route::post('/product', [AdminController::class, 'storeProduct'])->name('admin.product.store');
    Route::get('/product/{id}', [AdminController::class, 'showProduct'])->name('admin.product.show');
    Route::get('/product/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.product.edit');
    Route::put('/product/{id}', [AdminController::class, 'updateProduct'])->name('admin.product.update');
    Route::delete('/product/{id}', [AdminController::class, 'destroyProduct'])->name('admin.product.destroy');
    
    // Legacy route names for backward compatibility - FIXED
    Route::get('/view_category', [AdminController::class, 'createCategory'])->name('admin.category.view');
    Route::post('/add_category', [AdminController::class, 'storeCategory'])->name('admin.category.add');
    Route::get('/show_category', [AdminController::class, 'categories'])->name('admin.category.show');
    Route::get('/delete_category/{id}', [AdminController::class, 'destroyCategory'])->name('admin.category.delete');
    Route::get('/update_category/{id}', [AdminController::class, 'editCategory'])->name('admin.category.edit');
    Route::post('/update_category_confirm/{id}', [AdminController::class, 'updateCategory'])->name('admin.category.update');
    
    Route::get('/view_product', [AdminController::class, 'createProduct'])->name('admin.product.view');
    Route::post('/add_product', [AdminController::class, 'storeProduct'])->name('admin.product.add');
    Route::get('/show_product', [AdminController::class, 'products'])->name('admin.product.show');
    Route::get('/delete_product/{id}', [AdminController::class, 'destroyProduct'])->name('admin.product.delete');
    Route::get('/update_product/{id}', [AdminController::class, 'editProduct'])->name('admin.product.edit');
    Route::post('/update_product_confirm/{id}', [AdminController::class, 'updateProduct'])->name('admin.product.update');
    
    // Order management routes
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/order/{id}', [AdminController::class, 'orderDetails'])->name('admin.order.details');
    Route::post('/order/status/{id}', [AdminController::class, 'updateOrderStatus'])->name('admin.order.status');
    Route::post('/update-order-status', [App\Http\Controllers\AdminController::class, 'updateOrderStatus'])->name('admin.update-order-status');
});

// Public product routes
Route::get('/products', [HomeController::class, 'all_products'])->name('products');
Route::get('/product_details/{id}', [HomeController::class, 'product_details'])->name('product.details');

// Cart actions (support both GET and POST methods)
Route::post('/add_cart/{id}', [HomeController::class, 'add_cart'])->name('cart.add');
Route::get('/add_cart/{id}', [HomeController::class, 'add_cart'])->name('cart.add.get');

// Category-based product listing
Route::get('/category/{id}', [HomeController::class, 'categoryProducts'])->name('category.products');

// Search functionality
Route::get('/search', [HomeController::class, 'search'])->name('search');
Route::get('/product/{id}', [HomeController::class, 'product_details'])->name('product.details');

// Search product functionality
Route::get('/search_product', [HomeController::class, 'search_product']);

// Category Routes
Route::get('/view_category', [AdminController::class, 'view_category']);
Route::post('/add_category', [AdminController::class, 'add_category']);
Route::get('/delete_category/{id}', [AdminController::class, 'delete_category']);

// Product Routes
Route::get('/view_product', [AdminController::class, 'view_product']);
Route::post('/add_product', [AdminController::class, 'add_product']);
Route::get('/delete_product/{id}', [AdminController::class, 'delete_product']);
Route::get('/edit_product/{id}', [AdminController::class, 'edit_product']);
Route::post('/update_product/{id}', [AdminController::class, 'update_product']);



// In routes/web.php
Route::post('/test-update-status', [App\Http\Controllers\AdminController::class, 'updateOrderStatus'])->name('update');