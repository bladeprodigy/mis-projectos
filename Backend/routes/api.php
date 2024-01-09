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
<<<<<<< HEAD
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);



Route::middleware('auth')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::get('/projects/{id}', [ProjectController::class, 'show']);
        Route::post('/projects', [ProjectController::class, 'create']);
        Route::put('/projects/{id}', [ProjectController::class, 'editById']);
        Route::post('/projects/{projectId}/users', [ProjectController::class, 'addUserToProject']);
        Route::delete('/projects/{projectId}/users/{userId}', [ProjectController::class, 'removeUserFromProject']);
        Route::get('/projects/{id}', [ProjectController::class, 'getById']);
        Route::delete('/projects/{id}', [ProjectController::class, 'delete']);
        Route::put('/projects/{id}/finish', [ProjectController::class, 'finish']);
        Route::get('/projects/ongoing', [ProjectController::class, 'getOngoing']);
        Route::get('/projects/finished', [ProjectController::class, 'getFinished']);
        Route::get('/projects/{projectId}/users', [ProjectController::class, 'getUsers']);
    });
=======

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::post('/', [UserController::class, 'store']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::prefix('projects')->group(function () {
    Route::get('/', [ProjectController::class, 'index']);
    Route::get('/{id}', [ProjectController::class, 'show']);
    Route::post('/', [ProjectController::class, 'store']);
    Route::put('/{id}', [ProjectController::class, 'update']);
    Route::delete('/{id}', [ProjectController::class, 'destroy']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
>>>>>>> parent of 6a5f8084 (Delete Backend directory in main zeby nie bylo konfliktow)
});
