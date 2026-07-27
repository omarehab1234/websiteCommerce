<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Models\Product;

Route::get('/', function () {
    $size = Product::count();
    if($size >  8){
        $products = Product::first(8);
    }
    else{$products = Product::all();}
    return view('welcome',['products'=> $products]);
})->name('home');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// auth
Route::get('/login', [AuthenController::class, 'showLogin'])->name('login');
Route::post('/login',[AuthenController::class,'validateLogin'])->name('login');
Route::get('/register', [AuthenController::class, 'showRegister'])->name('register');
Route::post('/register',[AuthenController::class,'validateRegister'])->name('register');
Route::post('/logout',[AuthenController::class,"destroy"])->name('logout');

// admin
Route::get("/admin",[AdminController::class,"show"])->name('admin');
// user
Route::get('/users/index', [UserController::class, 'show'])->name('users.index');

Route::patch('/users/{user}/admin', [UserController::class, 'makeAd'])->name('users.admin');

Route::delete('/users/{user}', [UserController::class, 'destroyDash'])->name('users.destroy');


// product
Route::get('/products/index', [ProductController::class, 'show'])->name('products.index');
Route::get('/products/indexUser', [ProductController::class, 'showUser'])->name('products.show');

Route::get('/products/create',[ProductController::class,'showForm'])->name('products.create');

Route::post('/products/create',[ProductController::class,'store'])->name('products.store');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
Route::patch('/products/{product}/edit', [ProductController::class, 'editProd'])->name('products.edit');

Route::delete('/products/{product}/destroy', [ProductController::class, 'destroy'])->name('products.destroy');
Route::get('/product/{product}/view',[ProductController::class,'view'])->name('product.view');

// cart
// this for add by + or Add
Route::post('/cart/{product}/cart',[CartController::class,'store'])->name('cart.add');

Route::post('/cart/{product}/dec',[CartController::class,'decrease'])->name('cart.dec');
Route::get('/cart/index',[CartController::class,'show'])->name('cart.index');

Route::get('/cart/done',[CartController::class,'showForm'])->name('cart.done');

Route::post('/cart/{total}/store',[CartController::class,'checkOut'])->name('checkout.store');

Route::post('/cart/{product}/remove',[CartController::class,'remove'])->name('cart.remove');


// category
Route::get('/categories/index',[CategoryController::class,"show"] )->name('categories.index');

Route::get('/categories/create',[CategoryController::class,'showForm'])->name('categories.create');

Route::post('/categories/create',[CategoryController::class,'store'])->name('categories.store');

Route::get('/categories/{category}/edit',[CategoryController::class,'edit'])->name('categories.edit');
Route::patch('/categories/{category}/edit',[CategoryController::class,'editCat'])->name('categories.edit');

Route::delete('/categories/{category}/delete',[CategoryController::class,'destroy'])->name('categories.destroy');


// order
Route::get('/orders/index',[OrderController::class,'showOrder'])->name('orders.showOrders');
Route::put('/orders/{order}/update',[OrderController::class,'update'])->name('orders.update');
Route::delete('/orders/{order}/delete',[OrderController::class,'destroy'])->name('orders.destroy');