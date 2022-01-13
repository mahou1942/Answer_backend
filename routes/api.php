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
    Route::post('/addProduct', 'App\Http\Controllers\Question3\ShoppingCart@addProduct');
    Route::delete('/removeProduct/{pid}', 'App\Http\Controllers\Question3\ShoppingCart@removeProduct');
    Route::patch('/updateProductNum', 'App\Http\Controllers\Question3\ShoppingCart@updateProductNum');
    Route::get('/getTotalPrice', 'App\Http\Controllers\Question3\ShoppingCart@getTotalPrice');
    Route::get('/getCurrentProductList', 'App\Http\Controllers\Question3\ShoppingCart@getCurrentProductList');
    // Route::get('/advance/{n}', 'App\Http\Controllers\Question1\Answer2@runCode');
});
