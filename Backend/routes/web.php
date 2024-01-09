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
});