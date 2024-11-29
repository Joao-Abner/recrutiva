<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller {
    public function loginRecruiter(Request $request) {
        return $this->login($request, 'recruiter');
    }

    public function loginCandidate(Request $request) {
        return $this->login($request, 'candidate');
    }

    private function login(Request $request, $role) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // busca um usuário no banco de dados com base no email fornecido na requisição.
        $user = User::where('email', $request->email)->first();

        // Verifica se o usuário existe e se a senha está correta
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }

        // Verifica se o usuário tem o papel correto
        if (($role === 'recruiter' && !$user->isRecruiter()) || ($role === 'candidate' && !$user->isCandidate())) {
            return response()->json(['message' => 'Acesso negado'], 403);
        }

        // Criar token de acesso
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json(['access_token' => $token, 'token_type' => 'Bearer', 'role' => $role]);
    }

    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();
        return response()->json(['message' => 'Logout realizado com sucesso']);
    }
}