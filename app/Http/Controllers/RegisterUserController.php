<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterUserController extends Controller
{
    // Fonction pour le formulaire d'ajout
    public function showForm()
    {
        return view('register');
    }

    // Fonction pour l'enregistrement d'un utilisateur
    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users',
            'mdp' => 'required|string|confirmed',
        ]);

        $user = new User();
        $user->nom = $request->nom;
        $user->prenom = $request->prenom;
        $user->login = $request->login;
        $user->mdp = Hash::make($request->mdp);
        $user->save();

        session()->flash('etat', 'Utilisateur ajouté');

        Auth::login($user);

        return redirect("/user");
    }
}
