<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Fonction pour le formulaire de changement du nom
    public function modifnomForm()
    {

        return view('modif_user');
    }

    // Fonction pour la modification du nom
    public function modifnom(Request $request)
    {

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',

        ]);
        $user = Auth::user();
        $user->nom = $validated['nom'];
        $user->prenom = $validated['prenom'];
        $user->save();

        session()->flash('etat', 'Modification effectuée');

        return redirect("/user");;

    }

    // Fonction pour le formulaire de changement du mdp
    public function modifmdpForm()
    {

        return view('modifmdp_user');
    }

    // Fonction pour la modification du mdp
    public function modifmdp(Request $request)
    {

        $request->validate([
            'newmdp' => 'required|string|confirmed',
        ]);
        $user = Auth::user();
        $user->mdp = Hash::make($request->newmdp);
        $user->save();

        session()->flash('etat', 'Modification effectuée');

        return redirect('/user');
    }

}
