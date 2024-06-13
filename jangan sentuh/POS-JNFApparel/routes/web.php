<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [UserController::class, 'login'])->name('login');
Route::get('register', [UserController::class, 'register'])->name('register');
Route::post('prosesLogin', [UserController::class, 'prosesLogin'])->name('prosesLogin');
Route::post('prosesRegister', [UserController::class, 'prosesRegister'])->name('prosesRegister');
Route::get('logout', [UserController::class, 'logout'])->name('logout');

Route::get('dashboard', [ProductController::class, 'dashboard'])->name('dashboard');
Route::get('catalog', [ProductController::class, 'catalog'])->name('catalog');
Route::get('order', [OrderController::class, 'order'])->name('order');  // user order history

/* profile */
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile', [ProfileController::class, 'store'])->name('profile.add');

/* cart */
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'store'])->name('cart.add');
Route::get('/cart/delete/{cartItemId}', [CartController::class, 'removeFromCart'])->name('cart.delete');

/* checkout */
Route::get('/checkout', [OrderController::class, 'index'])->name('checkout-page');
Route::post('/checkout', [OrderController::class, 'store'])->name('checkout');

/* order */
Route::post('/order-now', [OrderController::class, 'storeNow'])->name('order.add');

Route::group(['middleware' => 'admin'], function () {
    Route::get('user', [UserController::class, 'dashboard'])->name('user');
    Route::get('new', [UserController::class, 'newAccount'])->name('new');                  // page
    Route::post('add', [UserController::class, 'addAccount'])->name('add');                 // action
    Route::get('edit/{user}', [UserController::class, 'editAccount'])->name('edit');         // page
    Route::put('update/{user}', [UserController::class, 'updateAccount'])->name('update');   // action
    Route::get('delete/{user}', [UserController::class, 'deleteAccount'])->name('delete');   // action

    /* category */
    Route::get('category', [CategoryController::class, 'index'])->name('category');
    Route::get('category/new', [CategoryController::class, 'create'])->name('category.new');
    Route::post('category/add', [CategoryController::class, 'store'])->name('category.add');
    Route::get('category/edit/{category}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('category/update/{category}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('category/delete/{category}', [CategoryController::class, 'destroy'])->name('category.delete');

    /* product */
    Route::get('product', [ProductController::class, 'index'])->name('product');
    Route::get('product/new', [ProductController::class, 'create'])->name('product.new');
    Route::post('product/add', [ProductController::class, 'store'])->name('product.add');
    Route::get('product/edit/{product}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('product/update/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::get('product/delete/{product}', [ProductController::class, 'destroy'])->name('product.delete');

    /* sales */
    Route::get('sales', [OrderController::class, 'sales'])->name('sales');
    Route::get('sales/{order}', [OrderController::class, 'showSales'])->name('sales.detail');
});
