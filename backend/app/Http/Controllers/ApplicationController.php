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
            'resume' => 'nullable|string', // Permite texto livre para informações
        ]);

        // Verifica se a vaga existe e se é válida
        $job = Job::findOrFail($jobId);

        // Verifica se o candidato já se inscreveu na vaga
        $existingApplication = Application::where(
            'job_id', $jobId)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingApplication) {
            return response()->json(['message' => 'Você já se candidatou a esta vaga.'], 409); // Conflito
        }

        // Cria a candidatura associando o usuário logado à vaga
        $application = Application::create([
            'job_id' => $job->id,
            'user_id' => Auth::id(),
            'resume' => $request->resume,
        ]);

        return response()->json(['message' => 'Candidatura realizada com sucesso!', 'application' => $application], 201);
    }
}