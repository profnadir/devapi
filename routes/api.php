<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\APIAuthController;
use App\Http\Controllers\ProductsController;

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




// public routes
Route::post('/register', [APIAuthController::class, 'register']);
Route::post('/login', [APIAuthController::class, 'login']);
Route::get('/products/search/{name}',[ProductsController::class,'search']);
Route::apiResource('/products',ProductsController::class)->only(['index','show']);


// protected routes
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('/products',ProductsController::class)->only(['store','update','destroy']);
    Route::post('/logout', [APIAuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
