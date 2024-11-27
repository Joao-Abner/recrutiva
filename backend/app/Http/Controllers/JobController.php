<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the jobs.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): \Illuminate\Http\JsonResponse
    {
        // Recupera todas as vagas cadastradas
        $jobs = Job::paginate(10); // Paginando 10 vagas por página
        return response()->json($jobs); // Retorna as vagas em formato JSON
    }

    /**
     * Display a listing of jobs for the authenticated recruiter.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function myJobs(): \Illuminate\Http\JsonResponse
    {
        // Recupera apenas as vagas do recrutador logado
        $jobs = Job::where('user_id', Auth::id())->paginate(10); // Paginando 10 vagas por página
        return response()->json($jobs); // Retorna as vagas em formato JSON
    }

    /**
     * Store a newly created job in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request): \Illuminate\Http\JsonResponse
    {
        $this->validateJob($request); // Valida os dados da vaga

        // Verifica se o usuário está autenticado e se é um recrutador
        if (!Auth::check() || Auth::user()->role !== 'recruiter') {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Cria a nova vaga associada ao recrutador logado
        $job = Job::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'salary' => $request->salary,
            'location' => $request->location,
            'requirements' => $request->requirements,
        ]);

        return response()->json(['message' => 'Job created successfully!', 'job' => $job], 201);
    }

    /**
     * Display the specified job.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(int $id): \Illuminate\Http\JsonResponse
    {
        // Retornar uma vaga específica
        $job = Job::where('user_id', auth()->id())->findOrFail($id);
        return response()->json($job);
    }

    /**
     * Update the specified job in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, int $id): \Illuminate\Http\JsonResponse
    {
        // Atualizar uma vaga específica
        $this->validateJob($request); // Valida os dados da vaga

        $job = Job::where('user_id', auth()->id())->findOrFail($id);
        $job->update($request->all());

        return response()->json(['message' => 'Job updated successfully!', 'job' => $job]);
    }

    /**
     * Remove the specified job from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id): \Illuminate\Http\JsonResponse
    {
        // Deletar uma vaga específica
        $job = Job::where('user_id', auth()->id())->findOrFail($id);
        $job->delete();

        return response()->json(['message' => 'Job deleted successfully!']);
    }

    /**
     * Validate the job data.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function validateJob(Request $request): void
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|numeric',
            'location' => 'required|string|max:255',
            'requirements' => 'required|string',
        ]);
    }

    /**
     * Display the list of candidates for a specific job.
     *
     * @param int $jobId
     * @return \Illuminate\Http\JsonResponse
     */
    public function candidates($jobId): \Illuminate\Http\JsonResponse
    {
        // Verifica se a vaga pertence ao recrutador logado
        $job = Job::where('id', $jobId)->where('user_id', Auth::id())->first();

        if (!$job) {
            return response()->json(['message' => 'Job not found or unauthorized'], 404);
        }

        // Recupera os candidatos associados à vaga
        $candidates = $job->applications()->with('user')->get();

        return response()->json($candidates);
    }
}