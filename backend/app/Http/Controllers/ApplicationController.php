<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'job_id' => 'required|exists:jobs,id',
        ]);

        Application::create([
            'job_id' => $request->job_id,
            'candidate_id' => Auth::id(), // Associa a candidatura ao candidato logado
        ]);

        return redirect()->back()->with('success', 'Application submitted successfully!');
    }
}