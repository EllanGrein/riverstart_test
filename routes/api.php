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

Route::namespace('\App\Http\Controllers\Api')->group(function () {
    Route::apiResource('products', 'ProductController')->except('create', 'show', 'edit');
    Route::apiResource('categories', 'CategoryController')->except('create', 'show', 'edit', 'update', 'index');
});
