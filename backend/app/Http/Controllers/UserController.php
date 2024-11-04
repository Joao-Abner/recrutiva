<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    public function registerCandidate(Request $request)
    {
        // Validação dos campos para Candidato
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'candidate', // Define o papel como candidato
        ]);

        return response()->json(['message' => 'Candidate registered successfully!'], 201);
    }

    public function registerRecruiter(Request $request)
    {
        // Validação dos campos para Recrutador
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'first_name' => $request->first_name, // Nome do recrutador
            'last_name' => $request->last_name, 
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'recruiter', // Define o papel como recrutador
        ]);

        return response()->json(['message' => 'Recruiter registered successfully!'], 201);
    }
}