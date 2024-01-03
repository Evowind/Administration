<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use App\Models\Formation;
use App\Models\Planning;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //fonction retournant le formulaire pour ajouter un utilisateur
    public function ajout_userForm()
    {
        return view('admin_ajout');
    }

    //fonction pour rajouter un utilisateur
    public function ajout_user(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:users',
            'mdp' => 'required|string|confirmed',
            'type' => 'required',
        ]);
        $user = new User();
        $user->nom = $validated['nom'];
        $user->prenom = $validated['prenom'];
        $user->login = $validated['login'];
        $user->mdp = Hash::make($validated['mdp']);
        $user->type = $validated['type'];

        $user->save();

        $request->session()->flash('etat', 'Utilisateur ajouté');
        return redirect("/admin");
    }

    //fonction pour la liste des utilisateurs
    public function liste_utilisateur()
    {
        $users = User::all();
        return view('admin_liste_utilisateur', ['users' => $users]);
    }

    //fonction pour avoir le formulaire pour ajouter un cours
    public function ajout_coursForm()
    {
        $formations = Formation::all();
        $cour = null; // initialisez la variable $cour à null
        return view('admin_ajout_cours', compact('formations', 'cour'));
    }


    //fonction pour rajouter un cours
    public function ajout_cours(Request $request)
    {
        $validated = $request->validate([
            'intitule' => 'required|string|max:255',
            'formation_id' => 'nullable|integer|exists:formations,id',
        ]);

        $cour = new Cour();
        $cour->intitule = $validated['intitule'];

        if (isset($validated['formation_id'])) {
            $cour->formation_id = $validated['formation_id'];
        }

        $cour->user_id = auth()->user()->id;
        $cour->save();

        $request->session()->flash('etat', 'Cours ajouté');
        return redirect("/admin");
    }


    public function liste_cours_admin()
    {
        $cours = Cour::all();
        return view('admin_liste_cours_admin', ['cours' => $cours]);
    }

    //fonction pour le formulaire d'acceptation
    public function accepterForm($id)
    {
        $user = User::findOrFail($id);
        return view('admin_accepter', ['user' => $user]);
    }

    //fonction pour acepter un utilisateur
    public function accepter(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $validated = $request->validate([
            'type' => 'required',
        ]);

        $user->type = $validated['type'];

        $user->save();

        $request->session()->flash('etat', 'Utilisateur accepté');

        return redirect("/admin");

    }

    //fonction pour demander la validation du refus
    public function refuserForm($id)
    {
        $user = User::findOrFail($id);
        return view('admin_refus', ['user' => $user]);
    }

    //fonction pour refuser un etudiant
    public function refuser(Request $request, $id)
    {
        if ($request->submit == 'Oui') {
            $user = User::findOrFail($id);
            //$user->cours()->detach();
            $user->delete();
            $request->session()->flash('etat', 'Utilisateur refusé');
            return redirect('/admin');
        } else {
        }
        return redirect('/admin');
    }

    //formulaire pour modifier un cours
    public function modif_coursForm($id)
    {
        $formations = Formation::all();
        $cours = Cour::findOrFail($id);
        return view('admin_modif_cours', ['cours' => $cours], ['formations' => $formations]);
    }

    //fonction pour modifier un cours
    public function modif_cours(Request $request, $id)
    {
        $cours = Cour::findOrFail($id);
        $validated = $request->validate([
            'intitule' => 'required|string|max:255',
            'formation_id' => 'nullable|integer',
        ]);

        $cours->intitule = $validated['intitule'];

        // Si une formation a été sélectionnée, on assigne la formation au cours
        if ($validated['formation_id']) {
            $formation = Formation::findOrFail($validated['formation_id']);
            $cours->formation()->associate($formation);
        } else {
            $cours->formation()->dissociate();
        }

        $cours->save();

        $request->session()->flash('etat', 'Cours modifié');

        return redirect("/admin");
    }


    //fonction pour avoir la liste des enseignant
    public function liste_enseignant()
    {
        $users = User::all()->where('type', '=', 'enseignant');
        return view('admin_liste_enseignant', ['users' => $users]);
    }

    //fonction pour avoir la liste des gestionnaire
    public function liste_gestionnaire()
    {
        $users = User::all()->where('type', '=', 'gestionnaire');
        return view('admin_liste_gestionnaire', ['users' => $users]);
    }

    //fonction pour rechercher un utilisateur
    public function search_users(Request $request)
    {
        $q = $request->input('q');
        $type = $request->input('type');
        $nom_prenom_login = $request->input('nom_prenom_login');

        $query = User::query();

        if ($q) {
            $query->where(function ($q2) use ($q) {
                $q2->where('nom', 'like', "%$q%")
                    ->orWhere('prenom', 'like', "%$q%")
                    ->orWhere('login', 'like', "%$q%");
            });
        }

        if ($type) {
            $query->where('type', $type);
        }

        if ($nom_prenom_login) {
            $query->orderBy($nom_prenom_login);
        }

        $users = $query->paginate(10);

        return view('admin_liste_utilisateur', compact('users'));
    }

    //formulaire pour modifier un utilisateur
    public function modif_usersForm($id)
    {
        $users = User::findOrFail($id);
        return view('admin_modif_users', ['users' => $users]);
    }

    //fonction pour modifier un utilisateur
    public function modif_users(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'login' => 'required|string|max:255',
            'mdp' => 'required|string|confirmed',
            'type' => 'required',
        ]);

        $user->nom = $validated['nom'];
        $user->prenom = $validated['prenom'];
        $user->login = $validated['login'];
        $user->mdp = Hash::make($validated['mdp']);
        $user->type = $validated['type'];

        $user->save();

        $request->session()->flash('etat', 'Utilisateur modifié');

        return redirect("/admin");

    }

    //fonction qui recupere un utilisateur et affiche la page de demande de supression
    public function suprimerForm($id)
    {
        $user = User::findOrFail($id);
        return view('admin_sup', ['user' => $user]);
    }

    //fonction pour suprimer un utilisateur
    public function suprimer(Request $request, $id)
    {
        if ($request->submit == 'Oui') {
            $user = User::findOrFail($id);
            //$user->cours()->detach();
            $user->delete();
            $request->session()->flash('etat', 'Utilisateur suprimer');
            return redirect('/admin');
        } else {
        }
        return redirect('/admin');
    }

    //fonction qui recupere un cours et affiche la page de demande de supression
    public function suprimer_coursForm($id)
    {
        $cour = Cour::findOrFail($id);
        return view('admin_sup_cours', ['cour' => $cour]);
    }

    //fonction pour suprimer un cours
    public function suprimer_cours(Request $request, $id)
    {
        // Trouver le cours à supprimer
        $cours = Cour::findOrFail($id);

        // Supprimer les connexions avec les plannings, s'ils existent
        $plannings = Planning::where('cours_id', $cours->id)->get();
        foreach ($plannings as $planning) {
            $planning->delete();
        }

        // Supprimer les connexions avec les formations, si elles existent
        if ($cours->formation) {
            $cours->formation->cours()->detach($cours->id);
        }

        // Supprimer le cours
        $cours->delete();

        // Rediriger vers la page d'accueil des cours
        return redirect()->route('liste_cours');
    }


    //fonction pour rechercher un cours
    public function search_cours(Request $request)
    {
        $key = trim($request->get('q'));

        $cours = Cour::query()
            ->where('intitule', 'like', "%{$key}%")
            ->get();

        return view('admin_search_cours', [
            'key' => $key,
            'cours' => $cours,
        ]);
    }

    //retourne la page admin avec les taches du gestionnaire et de l'enseignant
    public function admin_home_gestionnaire_enseignant()
    {
        return view('home_admin_gestionnaire_enseignant');
    }

    public function associer_cours_admin()
    {
        $cours = Cour::all();
        $enseignants = User::where('type', 'enseignant')->get();
        return view('admin_associer_cours_enseignement')->with(['cours' => $cours, 'enseignants' => $enseignants]);
    }

    public function associer_cours(Request $request)
    {
        // Retrieve the selected course and teacher IDs from the form
        $id_cours = $request->input('id_cours');
        $id_enseignant = $request->input('id_enseignant');

        // Find the course and teacher objects from the database
        $cours = Cour::findOrFail($id_cours);
        $enseignant = User::findOrFail($id_enseignant);

        // Check if the teacher is already associated with the course
        if ($cours->user_id == $enseignant->id) {
            return redirect()->back()->withErrors('L\'enseignant est déjà associé à ce cours.');
        }

        // Associate the course and teacher
        $cours->user_id = $enseignant->id;
        $cours->save();

        // Redirect back to the page with a success message
        return redirect()->back()->with('success', 'Enseignant associé avec succès au cours.');
    }

    public function ajout_formationform()
    {
        return view('admin_ajout_formation');
    }

    public function ajout_formation(Request $request)
    {
        $request->validate([
            'intitule' => 'required|string|max:50',
            'user_id' => 'required|exists:users,id'
        ]);

        $formation = new Formation([
            'intitule' => $request->input('intitule'),
            'user_id' => $request->input('user_id'),
        ]);

        $formation->save();

        return redirect()->back()->with('success', 'Formation ajoutée avec succès.');
    }

    public function liste_formation()
    {
        $formations = Formation::all();
        return view('admin_liste_formation')->with('formations', $formations);;
    }

    public function associer_formationForm()
    {
        $formations = Formation::all();
        $users = User::where('type', 'etudiant')->get();
        return view('admin_associer_formation_etudiant', compact('formations', 'users'));
    }

    public function associer_formation(Request $request)
    {
        $formations = $request->formations;
        if (!isset($formations)) {
            return redirect()->back()->with('error', 'Veuillez sélectionner au moins une formation.');
        }

        foreach ($formations as $id => $formation_id) {
            $etudiant = User::findOrFail($id);
            if ($etudiant->type != 'etudiant') {
                continue;
            }
            $etudiant->formation_id = $formation_id;
            $etudiant->save();
        }

        return redirect()->back()->with('success', 'Formations affectées avec succès');
    }

    //formulaire pour modifier une formation
    public function modif_formationForm($id)
    {
        $formation = Formation::findOrFail($id);
        return view('admin_modif_formation', compact('formation'));
    }

    public function modif_formation(Request $request, $id)
    {
        $formation = Formation::findOrFail($id);
        $validated = $request->validate([
            'intitule' => 'required|string|max:255',
        ]);

        $formation->intitule = $validated['intitule'];

        $formation->save();

        $request->session()->flash('etat', 'Formation modifiée');

        return redirect("/admin");
    }

    public function suprimer_formationform($id)
    {
        $formation = Formation::findOrFail($id);
        return view('admin_sup_formation', compact('formation'));
    }

    public function suprimer_formation($id)
    {
        $formation = Formation::findOrFail($id);

        // Supprimer tous les cours qui font référence à cette formation
        $formation->cours()->delete();

        // Supprimer la formation
        $formation->delete();

        return redirect("/admin");
    }


    public function ajout_seanceForm()
    {
        $cours_list = Cour::all();
        $enseignant_list = User::where('type', 'enseignant')->get();

        return view('admin_ajout_seance', ['cours_list' => $cours_list, 'enseignant_list' => $enseignant_list]);
    }

    public function ajout_seance(Request $request)
    {
        $request->validate([
            'cours_id' => 'required|integer',
            'date_debut' => 'required|date|after_or_equal:today',
            'date_fin' => 'required|date|after_or_equal:date_debut',
        ]);

        $cours = Cour::where('id', $request->cours_id)->firstOrFail();

        $planning = new Planning();
        $planning->cours_id = $cours->id;
        $planning->date_debut = $request->date_debut;
        $planning->date_fin = $request->date_fin;
        $planning->save();

        return redirect()->back()->with('success', 'Séance ajoutée avec succès.');
    }


}
