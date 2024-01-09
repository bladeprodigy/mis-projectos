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


Route::middleware('jwt.auth')->group(function () {
        Route::post('/projects', [ProjectController::class, 'store']);
        Route::get('/projects/ongoing', [ProjectController::class, 'getOngoingProjects']);
        Route::get('/projects/completed', [ProjectController::class, 'getCompletedProjects']);
        Route::patch('/projects/{project}/complete', [ProjectController::class, 'complete']);
        Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);
        Route::put('/projects/{project}', [ProjectController::class, 'update']);
        Route::get('/projects/{project}', [ProjectController::class, 'show']);
});