<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::post('user/register', [UserController::class, 'register']);
Route::post('user/login', [UserController::class, 'login']);
Route::put('user/change-password', [UserController::class, 'changePassword']);

Route::group(['middleware' => ['auth']], function () {
    Route::post('/projects', [ProjectController::class,'create']);
    Route::put('/projects/{id}', [ProjectController::class,'editById']);
    Route::get('/projects/{id}', [ProjectController::class,'getById']);
    Route::get('/projects', [ProjectController::class,'getALL']);
    Route::delete('/projects/{id}', [ProjectController::class,'delete']);
});