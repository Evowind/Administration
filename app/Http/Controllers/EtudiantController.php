<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Models\Planning;
use Illuminate\Support\Facades\Auth;

class EtudiantController extends Controller
{
    public function cour_etudiant_inscription_list()
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Vérifier si l'utilisateur est un étudiant
        if ($user->type === 'etudiant') {
            // Récupérer les cours liés à la formation de l'étudiant
            $cours = Cour::with('user')->whereHas('formation', function ($query) use ($user) {
                $query->where('id', $user->formation_id);
            })->get();


            // Récupérer les cours auxquels l'étudiant est inscrit
            $coursInscrits = $user->cours()->get();

            // Passer les cours à la vue
            return view('etudiant_inscription', compact('cours', 'coursInscrits'));
        }

        return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
    }

    public function cour_etudiant_inscription($id)
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Vérifier si l'utilisateur est un étudiant
        if ($user->type === 'etudiant') {
            // Récupérer le cours avec l'id correspondant
            $cours = Cour::find($id);

            // Vérifier si l'étudiant est déjà inscrit à ce cours
            if ($user->cours->contains($cours)) {
                return redirect()->back()->with('error', 'Vous êtes déjà inscrit à ce cours.');
            }

            // Ajouter le cours à la liste des cours de l'étudiant
            $user->cours()->attach($cours);

            return redirect()->back()->with('success', 'Vous avez été inscrit au cours.');
        }

        return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
    }

    public function cour_etudiant_desinscription($id)
    {
        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Vérifier si l'utilisateur est un étudiant
        if ($user->type === 'etudiant') {
            // Récupérer le cours avec l'id correspondant
            $cours = Cour::find($id);

            // Vérifier si l'étudiant est inscrit à ce cours
            if (!$user->cours->contains($cours)) {
                return redirect()->back()->with('error', 'Vous n\'êtes pas inscrit à ce cours.');
            }

            // Retirer le cours de la liste des cours de l'étudiant
            $user->cours()->detach($cours);

            return redirect()->back()->with('success', 'Vous avez été désinscrit du cours.');
        }

        return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à accéder à cette page.');
    }

    public function liste_seance()
    {
        $user = auth()->user();
        $coursIds = $user->cours()->pluck('cours.id')->toArray();
        $seances = Planning::whereIn('cours_id', $coursIds)->orderBy('date_debut')->get();
        return view('etudiant_liste_seance', compact('seances'));
    }

    public function liste_seance_cours_etudiant()
    {
        $user = auth()->user();
        $coursIds = $user->cours()->pluck('cours.id')->toArray();
        $seances = Planning::whereIn('cours_id', $coursIds)->orderBy('cours_id')->orderBy('date_debut')->get();
        return view('etudiant_liste_seances_cours', compact('seances'));
    }


    public function liste_seance_semaine_etudiant()
    {
        // Récupérer l'étudiant connecté
        $etudiant = Auth::user();

        // Récupérer les séances liées à l'étudiant connecté
        $seances = Planning::whereHas('cours.users', function ($query) use ($etudiant) {
            $query->where('id', $etudiant->id);
        })->get();

        // Ajouter le numéro de semaine à chaque séance
        foreach ($seances as $seance) {
            $seance->semaine = date('W', strtotime($seance->date_debut));
        }

        return view('etudiant_liste_seances_semaine', compact('seances'));
    }


}
