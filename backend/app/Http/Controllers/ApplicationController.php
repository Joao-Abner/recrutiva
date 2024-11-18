<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    /**
     * Store a new application.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function apply(Request $request, $jobId): \Illuminate\Http\JsonResponse
    {
        // Validação dos dados da candidatura
        $request->validate([
            'resume' => 'nullable|string',
        ]);

        // Verifica se a vaga existe e se é válida
        $job = Job::findOrFail($jobId);

        // Cria a candidatura associando o usuário logado à vaga
        $application = Application::create([
            'job_id' => $job->id,
            'user_id' => Auth::id(),
            'resume' => $request->resume,
        ]);

        return response()->json(['message' => 'Candidatura realizada com sucesso!', 'application' => $application], 201);
    }
}