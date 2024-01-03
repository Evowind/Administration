<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    // Fonction pour le formulaire d'authentification
    public function LoginForm()
    {
        return view('login');
    }

    // Fonction pour la connexion
    public function login(Request $request)
    {

        $request->validate([
            'login' => 'required|string',
            'mdp' => 'required|string',
        ]);

        $credentials = ['login' => $request->input('login'), 'password' => $request->input('mdp')];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $request->session()->flash('etat', 'Connexion réussie');

            return redirect()->intended('/user');
        }

        return back()->withErrors([
            'login' => "Les informations d'identification fournies ne correspondent pas à nos enregistrements.",
        ]);
    }

    // Fonction pour la deconnexion
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
