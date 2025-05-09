<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Question3\ShoppingCart;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('question1/basic/{n}', 'App\Http\Controllers\Question1\Answer@runCode');

// 題目一解答
Route::prefix('question1')->group(function () {
    Route::get('/basic/{n}', 'App\Http\Controllers\Question1\Answer@runCode');
    Route::get('/advance/{n}', 'App\Http\Controllers\Question1\Answer2@runCode');
});

// 題目二解答
Route::prefix('question2')->group(function () {
    Route::get('/2-1', 'App\Http\Controllers\Question2\Q2_1\Client@runCode');
    Route::get('/2-2', 'App\Http\Controllers\Question2\Q2_2\Client@runCode');
    // Route::get('/advance/{n}', 'App\Http\Controllers\Question1\Answer2@runCode');
});

// 題目三解答
Route::prefix('question3')->group(function () {

    // 不需要登入的購物車操作
    Route::post('/addProduct', [ShoppingCart::class, 'addProduct']);
    Route::get('/getTotalPrice', [ShoppingCart::class, 'getTotalPrice']);
    // 需要登入驗證才能操作的
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/getCurrentProductList', [ShoppingCart::class, 'getCurrentProductList']);
        Route::patch('/updateProductNum', [ShoppingCart::class, 'updateProductNum']);
        Route::delete('/removeProduct/{pid}', [ShoppingCart::class, 'removeProduct']);
    });
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// 測試 token 是否有效的路由（需要登入才能用）
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


