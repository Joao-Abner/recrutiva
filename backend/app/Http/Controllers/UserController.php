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
            'gender' => 'required|in:Male,Female,Other',
            'password' => 'required|string|min:8|confirmed',
            'phone' => [
            'nullable',
            'string',
            'unique:users',
            'regex:/^\(\d{2}\) \d{5}-\d{4}$/' // regex para telefone no formato (XX) XXXXX-XXXX
            ],  
            'birth_date' => 'nullable|date',
            'country' => ['required', Rule::in(array_column(\App\Enums\CountryEnum::cases(), 'value'))],
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'gender' => $request->gender,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'birth_date' => $request->birth_date,
            'country' => $request->country,
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
            'phone' => [
            'nullable',
            'string',
            'unique:users',
            'regex:/^\(\d{2}\) \d{5}-\d{4}$/' // regex para telefone no formato (XX) XXXXX-XXXX
            ],  
            'cnpj' => 'required|string|unique:users',
            'country' => ['required', Rule::in(array_column(\App\Enums\CountryEnum::cases(), 'value'))], // validação dos paises com base no arquivo CountryEnum
        ]);

        User::create([
            'company_name' => $request->company_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone' => $request->phone,
            'cnpj' => $request->cnpj,
            'role' => 'recruiter', // Define o papel como recrutador
        ]);

        return response()->json(['message' => 'Recruiter registered successfully!'], 201);
    }
}