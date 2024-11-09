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
        return view('jobs.index', compact('jobs'));
    }
}
