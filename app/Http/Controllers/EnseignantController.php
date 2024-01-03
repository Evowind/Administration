<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Models\Planning;
use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnseignantController extends Controller
{

    //fonction pour voir la liste des cours associer à un enseignant
    public function liste_associer_coursForm()
    {
        $users = User::all();
        return view('enseignant_liste_cours_enseignant', ['users' => $users]);
    }

    //fonction pour voir la liste des cours associer à un enseignant
    public function liste_associer_cours(Request $request)
    {

        $validated = $request->validate([
            'user_id' => 'required|numeric'
        ]);

        $users = User::findOrFail($validated['user_id']);
        $cours = $users->cours;
        $allUsers = DB::table('users')->get();

        return view('enseignant_liste_cours_enseignant', ['users' => $allUsers], ['cours' => $cours]);
    }

    //fonction pour voir la liste des associations des enseignants
    public function liste_associer_etudiantForm_enseignant()
    {
        $cours = Cour::all();
        $allPlannings = DB::table('plannings')->get();
        return view('enseignant_liste_cours_etudiant', ['cours' => $cours], ['plannings' => $allPlannings]);
    }

    //fonction pour voir la liste des associations des enseignants
    public function liste_associer_etudiant_enseignant(Request $request)
    {

        $validated = $request->validate([
            'cours_id' => 'required|numeric'
        ]);

        $cours = Cour::findOrFail($validated['cours_id']);
        $etudiants = $cours->etudiants;
        $allCours = DB::table('cours')->get();
        $allPlannings = DB::table('plannings')->get();

        return view('enseignant_liste_cours_etudiant', ['cours' => $allCours], ['etudiants' => $etudiants], ['plannings' => $allPlannings]);
    }

    public function liste_cours_enseignant()
    {
        $cours = Cour::where('user_id', '=', Auth::id())->get();
        return view('enseignant_liste_cours', ['cours' => $cours]);
    }

    public function liste_seance()
    {
        $enseignant_id = Auth::user()->id;
        $plannings = Planning::whereHas('cours', function ($query) use ($enseignant_id) {
            $query->where('user_id', $enseignant_id);
        })->with('cours')->paginate(100);
        return view('enseignant_liste_seances', ['seances' => $plannings]);
    }


    public function ajout_seance(Request $request)
    {

        $user = Auth::user();

        $validated = $request->validate([
            'cours_id' => 'required',
            'date_debut' => 'required',
            'date_fin' => 'required',
        ]);

        $cours = Cour::where('id', $validated['cours_id'])->where('user_id', $user->id)->firstOrFail();

        $planning = new Planning();
        $planning->cours_id = $cours->id;
        $planning->date_debut = $validated['date_debut'];
        $planning->date_fin = $validated['date_fin'];
        $planning->save();

        $request->session()->flash('etat', 'Séance ajoutée avec succès');

        return redirect("/enseignant");

    }


    public function ajout_seanceForm()
    {
        $user = Auth::user();
        $cours_list = Cour::where('user_id', $user->id)->get();

        return view('enseignant_ajout_seance', ['cours_list' => $cours_list]);
    }

    //recupere un etudiant et retourne le formulaire de modification
    public function modif_seanceForm($id)
    {
        $plannings = Planning::findOrFail($id);
        return view('enseignant_modif_seance', ['seances' => $plannings]);
    }

    //fonction pour modifier un etudiant
    public function modif_seance(Request $request, $id)
    {

        $planning = Planning::findOrFail($id);
        $validated = $request->validate([
            'date_debut' => 'required',
            'date_fin' => 'required',
        ]);
        $planning->date_debut = $validated['date_debut'];
        $planning->date_fin = $validated['date_fin'];

        $planning->save();

        $request->session()->flash('etat', 'Planning modifié');

        return redirect("/enseignant");

    }

    public function modif_seanceForm_cour($id)
    {
        $planning = Planning::findOrFail($id);
        $user = Auth::user();
        $cours = Cour::where('user_id', $user->id)->get();
        return view('enseignant_modif_cour_seance', ['seances' => $planning, 'cours' => $cours]);
    }

    public function modif_seance_cour(Request $request, $id)
    {
        $planning = Planning::findOrFail($id);
        $enseignant = auth()->user()->enseignant;

        $validated = $request->validate([
            'cours' => 'required',
        ]);

        $cours_id = $validated['cours'];
        $planning->cours_id = $cours_id;
        $planning->save();

        $request->session()->flash('etat', 'Cours modifié');

        return redirect("/enseignant");
    }

    //fonction qui recupere une seance et affiche la page de demande de supression
    public function suprimer_seanceForm($id)
    {
        $plannings = Planning::findOrFail($id);
        return view('enseignant_sup_seances', ['seances' => $plannings]);
    }

    //fonction pour suprimer une seance
    public function suprimer_seances(Request $request, $id)
    {
        if ($request->submit == 'Oui') {
            $plannings = Planning::findOrFail($id);
            $plannings->cours()->dissociate();
            $plannings->delete();
            $request->session()->flash('etat', 'sceance suprimer');
            return redirect('/enseignant');
        } else {
        }
        return redirect('/enseignant');
    }

    public function liste_seance_cours_enseignant()
    {
        $enseignant_id = Auth::user()->id;
        $cours = Cour::where('user_id', $enseignant_id)->get();
        $seances = [];
        foreach ($cours as $cour) {
            $seances_par_cours = Planning::where('cours_id', $cour->id)->with('cours')->paginate(100);
            $seances[] = ['cour' => $cour, 'seances' => $seances_par_cours];
        }
        return view('enseignant_liste_seances_cours', ['seances' => $seances]);
    }

    public function liste_seance_semaine_enseignant()
    {
        $enseignant_id = Auth::user()->id;
        $cours = Cour::where('user_id', $enseignant_id)->get();
        $seances_par_semaine = [];

        foreach ($cours as $cour) {
            $plannings = Planning::where('cours_id', $cour->id)->get();

            foreach ($plannings as $planning) {
                // Calculer le numéro de semaine de la séance
                $date_debut = new DateTime($planning->date_debut);
                $num_semaine = intval($date_debut->format('W'));

                // Ajouter la séance à la semaine correspondante
                if (!isset($seances_par_semaine[$num_semaine])) {
                    $seances_par_semaine[$num_semaine] = [];
                }
                $seances_par_semaine[$num_semaine][] = ['cour' => $cour, 'seance' => $planning];
            }
        }

        return view('enseignant_liste_seances_semaine', ['seances_par_semaine' => $seances_par_semaine]);
    }


}
