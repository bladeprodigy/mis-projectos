<?php

use Illuminate\Support\Facades\Route;
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



Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);


Route::middleware('auth')->group(function () {
    Route::post('/create', 'ProjectController@create');
    Route::put('/edit/{id}', 'ProjectController@editById');
    Route::get('projects/getBy{id}', [ProjectController::class,'getById']);
    Route::get('projects/getAll', [ProjectController::class,'getALL']);
});
