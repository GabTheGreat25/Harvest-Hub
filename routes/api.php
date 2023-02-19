<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/product', "ProductController");
Route::patch("/product/restore/{id}", ["uses" => "ProductController@restore"]);
Route::delete("/product/forceDelete/{id}", ["uses" => "ProductController@forceDelete"]);

Route::apiResource('/user', "UserController");
Route::patch("/user/restore/{id}", ["uses" => "UserController@restore"]);
Route::delete("/user/forceDelete/{id}", ["uses" => "UserController@forceDelete"]);

Route::apiResource('/transaction', "TransactionController");
Route::patch("/transaction/restore/{id}", ["uses" => "TransactionController@restore"]);
Route::delete("/transaction/forceDelete/{id}", ["uses" => "TransactionController@forceDelete"]);

Route::apiResource('/transaction-line', "TransactionLineController");
Route::patch("/transaction-line/restore/{id}", ["uses" => "TransactionLineController@restore"]);
Route::delete("/transaction-line/forceDelete/{id}", ["uses" => "TransactionLineController@forceDelete"]);

Route::apiResource('/customer', "CustomerController");
Route::patch("/customer/restore/{id}", ["uses" => "CustomerController@restore"]);
Route::delete("/customer/forceDelete/{id}", ["uses" => "CustomerController@forceDelete"]);

Route::apiResource('/cart', "CartController");
Route::patch("/cart/restore/{id}", ["uses" => "CartController@restore"]);
Route::delete("/cart/forceDelete/{id}", ["uses" => "CartController@forceDelete"]);

Route::apiResource('/cart-line', "CartLineController");
Route::patch("/cart-line/restore/{id}", ["uses" => "CartLineController@restore"]);
Route::delete("/cart-line/forceDelete/{id}", ["uses" => "CartLineController@forceDelete"]);

Route::apiResource('/admin', "AdminController");
Route::patch("/admin/restore/{id}", ["uses" => "AdminController@restore"]);
Route::delete("/admin/forceDelete/{id}", ["uses" => "AdminController@forceDelete"]);

Route::apiResource('/farmer', "FarmerController");
Route::patch("/farmer/restore/{id}", ["uses" => "FarmerController@restore"]);
Route::delete("/farmer/forceDelete/{id}", ["uses" => "FarmerController@forceDelete"]);
