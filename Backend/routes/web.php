<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
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
Route::get('pages', [PageController::class, 'index']);
Route::get('pages/{slug}', [PageController::class, 'show']);
Route::get('pages/create', [PageController::class, 'create']);
Route::post('pages', [PageController::class, 'store']);

Route::post('user/register', [UserController::class, 'register']);
Route::post('user/login', [UserController::class, 'login']);
Route::put('user/change-password', [UserController::class, 'changePassword']);