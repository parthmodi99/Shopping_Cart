<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserLoginController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserProductController;
use App\Http\Controllers\User\CartController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['web'])->group(function () {

    //Auth
    Route::get('/', [UserLoginController::class, 'login'])->name('login');
    Route::get('/signuppage', [UserLoginController::class, 'signuppage'])->name('signuppage');
    Route::post('/dologin', [UserLoginController::class, 'dologin'])->name('dologin');
    Route::post('/dosignup', [UserLoginController::class, 'dosignup'])->name('dosignup');
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('/logout', [UserLoginController::class, 'logout'])->name('logout');

    //Dashboard
    Route::get('/dashboard', [UserController::class, 'home'])->name('dashboard');

    //ProductList
    Route::resource('user_product', UserProductController::class);
    Route::post('/product_list', [UserProductController::class, 'product_list'])->name('product_list');

    //Cart
    Route::resource('cart', CartController::class);
});
