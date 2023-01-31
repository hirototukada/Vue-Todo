<?php

use App\Http\Controllers\Todo\TodoController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Todo取得
Route::get('/todo', [TodoController::class, 'index']);
Route::get('/editSearch/{id}', [TodoController::class, 'searchEditData']);
// todoインサート
Route::post('/todoAdd', [TodoController::class, 'todoAdd']);
Route::post('/todoEdit', [TodoController::class, 'todoEdit']);
