<?php

use App\Models\Payment;
use function Laravel\Prompts\confirm;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;

use App\Http\Controllers\AdminDashboardController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'rolemanager:customer'])->name('dashboard');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified', 'rolemanager:admin'])->name('admin.dashboard');

Route::get('/seller/dashboard', function () {
    return view('seller.dashboard');
})->middleware(['auth', 'verified', 'rolemanager:seller'])->name('seller.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
//nearest branch
Route::get('/api/nearest-branch', [BranchController::class, 'nearest'])->name('branches.nearest');

//categories
//all authenticated can view categories
Route::middleware(['auth'])->group(function(){
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    //only for ADMIN AND SELLER 
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::GET('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
 Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');

Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');
});

//products
Route::middleware(['auth'])->group(function(){
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/payment/{orderId}/confirm',[PaymentController::class, 'confirm'])->name('payment.confirm');
Route::post('/payment/pay/{order}', [PaymentController::class, 'pay'])->name('payment.pay');
});
Route::middleware(['auth', 'rolemanager:admin'])->group(function(){
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/paid-orders', [OrderController::class, 'paidOrder'])->name('admin.paid.orders');
    Route::patch('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.update-status');
});
//carts route
Route::middleware(['auth', 'rolemanager:customer'])->prefix('customer')->name('customer.')->group(function(){
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
 Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

//orders
  Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders/place', [OrderController::class, 'place'])->name('orders.place');

});


require __DIR__.'/auth.php';
 