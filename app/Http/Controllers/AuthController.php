<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Enregistrement d'un nouvel utilisateur
    public function register(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6'
            ]);
    
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            return response()->json(['token' => $user->createToken('API Token')->plainTextToken]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // Connection d'un utilisateur existant
    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required'
            ]);
    
            $user = User::where('email', $request->email)->first();
    
            if ($user && Hash::check($request->password, $user->password)) {
                return response()->json(['token' => $user->createToken('API Token')->plainTextToken]);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // Déconnection d'n utilisateur connecté
    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return response()->json(['message' => 'Déconnexion réussie']);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    // Informations de l'utilisateur connecté
    public function user()
    {
        try {
            return response()->json(auth()->user());
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
