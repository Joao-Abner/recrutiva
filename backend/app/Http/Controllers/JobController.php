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
        ]);

        Job::create([
            'title' => $request->title,
            'description' => $request->description,
            'recruiter_id' => Auth::id(), // Associa a vaga ao recrutador logado
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully!');
    }

    public function index()
    {
        $jobs = Job::all(); // Recupera todas as vagas
        return view('jobs.index', compact('jobs'));
    }
}
