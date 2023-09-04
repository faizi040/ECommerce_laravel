<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


Route::get('/', [HomeController::class, 'index']);
Route::get('/redirect', [HomeController::class, 'redirect'])->middleware('auth','verified');

// user Routes
// user Routes
// user Routes
Route::get('/product_details/{product}', [HomeController::class, 'product_details']);

Route::group(['middleware' => 'auth'], function () {
    
    Route::post('/add_cart/{product}', [HomeController::class, 'add_cart']);
    Route::get('/show_cart', [HomeController::class, 'show_cart']);
    Route::get('/remove_cart/{cart}', [HomeController::class, 'remove_cart']);
    
    Route::get('/show_order', [HomeController::class, 'show_order']);
    Route::get('/cancel_order/{order}', [HomeController::class, 'cancel_order']);

    Route::get('/cash_order', [HomeController::class, 'cash_order']);
    Route::get('/stripe/{totalPrice}', [HomeController::class, 'stripe']);
    Route::post('/stripe/{totalPrice}', [HomeController::class, 'stripePost'])->name('stripe.post');

    Route::post('/add_comment',[HomeController::class,'add_comment']);
    Route::post('/add_reply',[HomeController::class,'add_reply']);

    // admin routes
    // admin routes

    // Category Crud routes
    // Category Crud routes
    // Category Crud routes
    Route::get('/view_category', [AdminController::class, 'view_category']);
    Route::post('/add_category', [AdminController::class, 'add_category']);
    Route::get('/delete_category/{category}', [AdminController::class, 'delete_category']);
    

    Route::get('/order', [AdminController::class, 'order']);
    Route::get('/devilered/{order}', [AdminController::class, 'devilered']);
    Route::get('/download_pdf/{order}', [AdminController::class, 'download_pdf']);
    Route::get('/send_email/{order}', [AdminController::class, 'send_email']);
    Route::post('/send_user_email/{order}', [AdminController::class, 'send_user_email']);
    Route::get('/search', [AdminController::class, 'searchData']);


    // Product Crud routes
    Route::get('/view_product', [ProductController::class, 'view_product']);
    Route::post('/add_product', [ProductController::class, 'add_product']);
    Route::get('/show_product', [ProductController::class, 'show_product']);
    Route::get('/delete_product/{product}', [ProductController::class, 'delete_product']);
    Route::get('/edit_product/{product}', [ProductController::class, 'edit_product']);
    Route::put('/update_product/{product}', [ProductController::class, 'update_product']);
});