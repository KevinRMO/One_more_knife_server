<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\Company;
use App\Models\User;

class LoginController extends Controller
{
    public function authenticate(Request $request): JsonResponse
    {
        try {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            $user = null;
            $category = null;

            // Vérifier si l'email appartient à la table 'users'
            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                $category = 'Candidat';
            }

            // Si l'authentification en tant que 'Candidat' échoue, essayez en tant que 'Entreprise'
            if (!$user && Auth::guard('company')->attempt($credentials)) {
                $user = Auth::guard('company')->user();
                $category = 'Entreprise';
            }

            if ($user) {
                $token = $user->createToken('authToken')->plainTextToken;

                return response()->json(['success' => true, 'message' => 'Authentication successful', 'token' => $token, 'category' => $category]);
            }

            throw ValidationException::withMessages(['email' => 'Invalid credentials']);

        } catch (ValidationException $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
}

