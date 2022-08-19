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

Route::post('/upload_product','App\Http\Controllers\api\ProductController@upload_product');

Route::post('/upload_order','App\Http\Controllers\api\ProductController@upload_order');

Route::get('/get_products','App\Http\Controllers\api\ProductController@get_products');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


