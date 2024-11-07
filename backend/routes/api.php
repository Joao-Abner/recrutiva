<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
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

// Rotas para registro
Route::post('/register-candidate', [UserController::class, 'registerCandidate']);
Route::post('/register-recruiter', [UserController::class, 'registerRecruiter']);

// Rotas para login
Route::post('/login-recruiter', [AuthController::class, 'loginRecruiter']);
Route::post('/login-candidate', [AuthController::class, 'loginCandidate']);

// Rota para criar vagas
Route::post('/jobs/create', [JobController::class, 'store']);

// Rotas protegidas
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
