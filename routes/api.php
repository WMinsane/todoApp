<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\TodoController;

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
Route::get('getTodoList',[TodoController::class,'getTodoList']);
Route::post('getTodo',[TodoController::class,'getTodo']);
Route::post('updateTodo',[TodoController::class,'updateTodo']);
Route::post('createTodo',[TodoController::class,'createTodo']);
Route::post('deleteTodo',[TodoController::class,'deleteTodo']);