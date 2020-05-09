<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/**
 *  Buyers
 */
Route::resource('buyer', 'Api\Buyer\BuyerController',['only' => ['index','show']]);
/**
 *  Categories
 */
Route::resource('categories', 'Api\Category\CategoryController',['except' => ['create','edit']]);
/**
 *  Products
 */
Route::resource('products', 'Api\Product\ProductController',['only' => ['index','show']]);
/**
 *  Sellers
 */
Route::resource('sellers', 'Api\Seller\SellerController',['only' => ['index','show']]);
/**
 *  Transactions
 */
Route::resource('transactions', 'Api\Transaction\TransactionController',['only' => ['index','show']]);
/**
 *  Users
 */
Route::resource('users', 'Api\User\UserController',['except' => ['create','edit']]);