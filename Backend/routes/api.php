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



Route::middleware('auth')->group(function () {
        Route::middleware('auth')->group(function () {
            Route::post('/projects', [ProjectController::class, 'store']);
            Route::get('/projects/ongoing', [ProjectController::class, 'getOngoingProjects']);
            Route::get('/projects/completed', [ProjectController::class, 'getCompletedProjects']);
            Route::patch('/projects/{project}/complete', [ProjectController::class, 'complete']);
            Route::delete('/projects/{project}', [ProjectController::class, 'destroy']);
            Route::put('/projects/{project}', [ProjectController::class, 'update']);
            Route::get('/projects/{project}', [ProjectController::class, 'show']);
    });
});
