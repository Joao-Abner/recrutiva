<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    
    public function create()
    {
        return view('jobs.create'); // Formulário para criar vaga
    }
    
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'salary' => 'required|numeric',
            'location' => 'required|string|max:255',
            'requirements' => 'required|string',
        ]);
        
        // Verifica se o usuário está autenticado
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // $validate['user_id']= Auth::user()->id;

        Job::create([
            'user_id' => Auth::id(), // Associa a vaga ao recrutador logado
            'title' => $request->title,
            'description' => $request->description,
            'salary' => $request->salary,
            'location' => $request->location,
            'requirements' => $request->requirements,
        ]);

        // return redirect()->route('jobs.index')->with('success', 'Job created successfully!');
        return response()->json(['message' => 'Job created successfully!'], 201);
    }

    public function index()
    {
        $jobs = Job::all(); // Recupera todas as vagas
        return response()->json($jobs); // Retorna as vagas em formato JSON
    }

    public function edit($id)
    {
        // Editar uma vaga específica
        $job = Job::where('user_id', auth()->id())->findOrFail($id);
        return view('jobs.edit', compact('job'));
    }

    public function update(Request $request, $id)
    {
        // Atualizar uma vaga específica
        $job = Job::where('user_id', auth()->id())->findOrFail($id);
        $job->update($request->all());
        return redirect()->route('jobs.index')->with('success', 'Job updated successfully!');
    }

    public function destroy($id)
    {
        // Deletar uma vaga específica
        $job = Job::where('user_id', auth()->id())->findOrFail($id);
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully!');
    }

}
