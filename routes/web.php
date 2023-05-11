<?php

use App\Models\Food;
use App\Models\Categories;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SendEmailController;

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


Route::get('/', [HomeController::class, 'index']);

Auth::routes();


Route::middleware(['auth', 'user-access:user'])->group(function () {
  
    Route::get('/home', [UserController::class, 'index'])->name('home');
    Route::get('/home/{food:slug}', [UserController::class, 'show'])->name('home.detail');
    Route::post('/home/store', [UserController::class, 'store'])->name('home.detail.store');
    // profile
    Route::get('profile/{id}', [UserController::class, 'profile'])->name('home.profile');
    Route::put('profile/update', [UserController::class, 'profileupdate'])->name('home.profile.update');
    //cart
    Route::get('cart/{id}', [UserController::class, 'showcart'])->name('home.cart');
    Route::delete('cart/destroy', [UserController::class, 'destroycart'])->name('home.cart.destroy');
    Route::put('cart/update', [UserController::class, 'updatecart'])->name('home.cart.update');
    Route::put('cart/updatecourier', [UserController::class, 'updatecourier'])->name('home.cart.updatecourier');
    //order
    Route::post('/cart/storecart', [UserController::class, 'storecart'])->name('home.cart.storecart');
    Route::get('/order/{id}', [OrderController::class, 'showorder'])->name('home.order');
    Route::post('order/transaction', [OrderController::class, 'transaction'])->name('home.transaction');
});

Route::middleware(['auth', 'user-access:admin'])->group(function () {
    //Dashboard  
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::delete('/admin/dashboard/destroy', [AdminController::class, 'destroy'])->name('admin.dashboard.destroy');
    Route::put('/admin/dashboard/update', [AdminController::class, 'update'])->name('admin.dashboard.update');
    //Add Makanan
    Route::get('/admin/dashboard/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/dashboard/create/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/dashboard/create/checkSlug', [AdminController::class, 'checkSlug']);
    //Add 
    Route::get('/admin/dashboard/createcate', [AdminController::class, 'createcate'])->name('admin.createcate');
    Route::post('/admin/dashboard/create/storecate', [AdminController::class, 'storecate'])->name('admin.storecate');
    Route::get('/admin/dashboard/create/checkSlugCate', [AdminController::class, 'checkSlugCate']);
    //Order makanan
    Route::get('/admin/dashboard/order', [OrderController::class, 'index'])->name('admin.order');
    Route::delete('/admin/dashboard/order/destroy', [OrderController::class, 'destroy'])->name('admin.order.destroy');
    Route::put('/admin/dashboard/order/konfirmasi', [OrderController::class, 'konfirmasi'])->name('admin.order.konfir');
    Route::post('/admin/dashboard/order/update', [OrderController::class, 'update'])->name('admin.order.update');
    Route::post('/admin/dashboard/order/updates', [OrderController::class, 'updates'])->name('admin.order.updates');
});




Route::get('send-email', [SendEmailController::class, 'index']);
Route::get('send', [SendEmailController::class, 'sendNewsletter']);