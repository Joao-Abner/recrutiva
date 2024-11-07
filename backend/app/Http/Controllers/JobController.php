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

        Job::create([
            'recruiter_id' => Auth::id(), // Associa a vaga ao recrutador logado
            'title' => $request->title,
            'description' => $request->description,
            'salary' => 'required|numeric',
            'location' => 'required|string|max:255',
            'requirements' => 'required|string',
        ]);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully!');
    }

    public function index()
    {
        $jobs = Job::all(); // Recupera todas as vagas
        return view('jobs.index', compact('jobs'));
    }
}
