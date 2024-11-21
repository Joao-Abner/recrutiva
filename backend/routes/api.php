<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;


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

// Rotas públicas para registro
Route::prefix('auth')->group(function () {
    Route::post('/register-candidate', [UserController::class, 'registerCandidate']);
    Route::post('/register-recruiter', [UserController::class, 'registerRecruiter']);
    
    // Rotas para login
    Route::post('/login-recruiter', [AuthController::class, 'loginRecruiter']);
    Route::post('/login-candidate', [AuthController::class, 'loginCandidate']);
});

// Rotas jobs pública 
Route::get('/jobs', [JobController::class, 'index']); // Listar todas as vagas

// Rotas protegidas que requerem autenticação
Route::middleware('auth:sanctum')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
    
    // Rotas para gerenciamento de vagas do recrutador
    Route::prefix('my-jobs')->group(function () {
        Route::get('/', [JobController::class, 'myJobs']); // Listar vagas do recrutador logado
        Route::post('/create', [JobController::class, 'store']); // Criar vaga
        Route::get('/{id}', [JobController::class, 'show']); // Exibir uma vaga específica
        Route::put('/{id}', [JobController::class, 'update']); // Atualizar vaga
        Route::delete('/{id}', [JobController::class, 'destroy']); // Deletar vaga
   
        // Rota para listar candidatos de uma vaga do recrutador logado
        Route::get('/{jobId}/candidates', [JobController::class, 'candidates']); 
    });

    // Rota para candidatar-se à vaga
    Route::post('/jobs/{jobId}/apply', [ApplicationController::class, 'apply']);
    

    // Rota para obter informações do usuário autenticado
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});