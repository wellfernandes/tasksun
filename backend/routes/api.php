<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
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

Route::prefix('v1')->group(function () {
    // Rotas de autenticação
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);

    // Rotas protegidas por autenticação
    Route::middleware('auth:sanctum')->group(function () {
        // Rota para obter o usuário autenticado
        Route::get('/user', function (Request $request) {
            return $request->user();
        });

        // Rotas de usuários
        Route::apiResource('users', UserController::class);

        // Rotas de tarefas
        Route::get('/tasks', [TaskController::class, 'index']);
        Route::get('/tasks/user/{userId}', [TaskController::class, 'getUserTasks']);
        Route::apiResource('tasks', TaskController::class)->except(['index']);
    });
});
