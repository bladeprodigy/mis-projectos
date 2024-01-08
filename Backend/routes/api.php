<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProjectController;

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
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);


Route::post('/create', [ProjectController::class,'create']);
Route::put('/editById', [ProjectController::class,'editById']);
Route::get('/getById', [ProjectController::class,'getById']);
Route::get('/getALL', [ProjectController::class,'getALL']);
 Route::delete('/delete', [ProjectController::class,'delete']);
    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
