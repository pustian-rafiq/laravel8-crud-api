<?php

use App\Http\Controllers\APi\AuthController;
use App\Http\Controllers\ProductController;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('register',[AuthController::class,'Register']);

Route::middleware(['auth:sanctum'])->group(function () {
    //product crud route
    Route::get('product/view', [ProductController::class, 'getProducts']);
    Route::get('product/{id}/show', [ProductController::class, 'getProduct']);
    Route::post('product/add', [ProductController::class, 'store']);
    Route::post('product/{id}/update', [ProductController::class, 'update']);
    Route::delete('product/{id}/delete', [ProductController::class, 'delete']);
});
