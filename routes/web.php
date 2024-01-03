<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\CourController;
use App\Http\Controllers\EnseignantController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\RegisterUserController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Route racine
Route::get('/', function () {
    return view('home');
});


//Routes pour la connexion
Route::get('/login', [AuthenticatedSessionController::class, 'LoginForm'])->name('login');
Route::post('/login', [AuthenticatedSessionController::class, 'login']);
//Route pour la deconnexion
Route::get('/logout', [AuthenticatedSessionController::class, 'logout'])->name('logout')->middleware('auth');
//Routes pour l'enregistrement
Route::get('/register', [RegisterUserController::class, 'showForm'])->name('register');
Route::post('/register', [RegisterUserController::class, 'store']);
//Page principal une fois connectée
Route::view('/user', 'home_user')->middleware('auth');
//Route pour la modification du nom et prenom
Route::get('/modifier', [UserController::class, 'modifnomForm'])->name('modifnomform')->middleware('auth');
Route::post('/modifier', [UserController::class, 'modifnom'])->name('modifnom')->middleware('auth');
//Route pour la modification du mdp
Route::get('/modifier_mdp', [UserController::class, 'modifmdpForm'])->name('modifmdpform')->middleware('auth');
Route::post('/modifier_mdp', [UserController::class, 'modifmdp'])->name('modifmdp')->middleware('auth');


//Page pour l'admin
Route::view('/admin', 'home_admin')->name('admin_home')->middleware('auth')->middleware('is_admin');
//Route pour ajouter l'utilisateur
Route::get('/admin/ajout', [AdminController::class, 'ajout_userForm'])->name('ajout_userform')->middleware('auth')->middleware('is_admin');
Route::post('/admin/ajout', [AdminController::class, 'ajout_user'])->name('ajout_user')->middleware('auth')->middleware('is_admin');
//Route pour voir la liste des utilisateurs
Route::get('/admin/user_liste', [AdminController::class, 'liste_utilisateur'])->name('liste_utilisateur')->middleware('auth')->middleware('is_admin');
//Route pour l'ajout d'un cours
Route::get('/admin/ajout_cours', [AdminController::class, 'ajout_coursForm'])->name('ajout_coursform')->middleware('auth')->middleware('is_admin');
Route::post('/admin/ajout_cours', [AdminController::class, 'ajout_cours'])->name('ajout_cours')->middleware('auth')->middleware('is_admin');
//Route pour ajouter l'utilisateur
Route::get('/admin/ajout', [AdminController::class, 'ajout_userForm'])->name('ajout_userform')->middleware('auth')->middleware('is_admin');
Route::post('/admin/ajout', [AdminController::class, 'ajout_user'])->name('ajout_user')->middleware('auth')->middleware('is_admin');
//Route pour voir la liste des utilisateurs
Route::get('/admin/user_liste', [AdminController::class, 'liste_utilisateur'])->name('liste_utilisateur')->middleware('auth')->middleware('is_admin');
//Route pour chercher un utilisateur
Route::get('/admin/user_liste', [AdminController::class, 'liste_utilisateur'])->name('liste_utilisateur')->middleware('auth')->middleware('is_admin');
//Route pour voir la liste des cours avec l'admin
Route::get('/admin/cours_liste', [AdminController::class, 'liste_cours_admin'])->name('liste_cours_admin')->middleware('auth')->middleware('is_admin');
//Route pour associer un cour avec un enseignant
Route::get('/admin/associer_cours_admin', [AdminController::class, 'associer_cours_admin'])->name('associer_cours_admin')->middleware('auth')->middleware('is_admin');
Route::post('/admin/associer_cours_admin', [AdminController::class, 'associer_cours'])->name('associer_cours')->middleware('auth')->middleware('is_admin');
//Route pour voir liste des ajout de formation
Route::get('/admin/ajout_formation_form', [AdminController::class, 'ajout_formationform'])->name('ajout_formationform')->middleware('auth')->middleware('is_admin');
//Route pour ajouter des formations
Route::get('/admin/ajout_formation', [AdminController::class, 'ajout_formation'])->name('ajout_formation')->middleware('auth')->middleware('is_admin');
Route::post('/admin/ajout_formation', [AdminController::class, 'ajout_formation'])->name('ajout_formation')->middleware('auth')->middleware('is_admin');
//Route pour voir liste des formations avec admin
Route::get('/admin/liste_formation', [AdminController::class, 'liste_formation'])->name('liste_formation')->middleware('auth')->middleware('is_admin');
//Route pour voir l'option affichant
Route::get('/admin/associer_formation', [AdminController::class, 'associer_formationForm'])->name('associer_formation')->middleware('auth')->middleware('is_admin');
//Route pour pouvoir lier un etudiant a une formation
Route::get('/admin/associer_formation_liste', [AdminController::class, 'associer_formation'])->name('associer_formation')->middleware('auth')->middleware('is_admin');
//Route pour afficher le formulaire d'affectation des formations aux étudiants
Route::get('/admin/associer_formation', [AdminController::class, 'associer_formationForm'])->name('associer_formation_form')->middleware('auth')->middleware('is_admin');
//Route pour chercher un cour
Route::get('/admin/cour_listes', [CourController::class, 'rechercher_cours_admin'])->name('rechercher_cours_admin')->middleware('auth')->middleware('is_admin');
//Route pour accepter un utilisateur
Route::get('/admin/{id}/accepter', [AdminController::class, 'accepterForm'])->name('accepterform')->middleware('auth')->middleware('is_admin');
Route::post('/admin/{id}/accepter', [AdminController::class, 'accepter'])->name('accepter')->middleware('auth')->middleware('is_admin');
//Route pour modifier un cours
Route::get('/admin/{id}/modifiercours', [AdminController::class, 'modif_coursForm'])->name('modif_coursform')->middleware('auth')->middleware('is_admin');
Route::post('/admin/{id}/modifiercours', [AdminController::class, 'modif_cours'])->name('modif_cours')->middleware('auth')->middleware('is_admin');//Route pour voir la liste des étudiant assacié à un cours
//Route pour refuser un utilisateur
Route::get('/admin/{id}/refuser', [AdminController::class, 'refuserForm'])->name('refuserform')->middleware('auth')->middleware('is_admin');
Route::post('/admin/{id}/refuser', [AdminController::class, 'refuser'])->name('refuser')->middleware('auth')->middleware('is_admin');
//Route pour la liste des enseignant
Route::get('/admin/listeenseignant', [AdminController::class, 'liste_enseignant'])->name('liste_enseignant')->middleware('auth')->middleware('is_admin');
//Route pour rechercher un utilisateur
Route::get('/searchutilisateur', [AdminController::class, 'search_users'])->name('rechercher_utilisateur_admin')->middleware('auth')->middleware('is_admin');
//Route pour modifier un utilisateur
Route::get('/admin/{id}/modifieruser', [AdminController::class, 'modif_usersForm'])->name('modif_usersform')->middleware('auth')->middleware('is_admin');
Route::post('/admin/{id}/modifieruser', [AdminController::class, 'modif_users'])->name('modif_users')->middleware('auth')->middleware('is_admin');
//Route pour suprimer un utilisateur
Route::get('/admin/{id}/suprimer', [AdminController::class, 'suprimerForm'])->name('suprimerform')->middleware('auth')->middleware('is_admin');
Route::post('/admin/{id}/suprimer', [AdminController::class, 'suprimer'])->name('suprimer')->middleware('auth')->middleware('is_admin');
//Route pour suprimer un cours
Route::get('/admin/{id}/suprimercours', [AdminController::class, 'suprimer_coursForm'])->name('suprimer_coursform')->middleware('auth')->middleware('is_admin');
Route::post('/admin/{id}/suprimercours', [AdminController::class, 'suprimer_cours'])->name('suprimer_cours')->middleware('auth')->middleware('is_admin');
//Route pour rechercher un cours
Route::get('/searchcours', [AdminController::class, 'search_cours'])->name('search_cours')->middleware('auth')->middleware('is_admin');
//Route pour modifier une formation
Route::get('/admin/{id}/modifierformation', [AdminController::class, 'modif_formationForm'])->name('modif_formationform')->middleware('auth')->middleware('is_admin');
Route::post('/admin/{id}/modifierformation', [AdminController::class, 'modif_formation'])->name('modif_formation')->middleware('auth')->middleware('is_admin');
//Route pour supprimer une formation
Route::get('/admin/{id}/suprimerformation', [AdminController::class, 'suprimer_formationForm'])->name('suprimer_formationform')->middleware('auth')->middleware('is_admin');
Route::post('/admin/{id}/suprimerformation', [AdminController::class, 'suprimer_formation'])->name('suprimer_formation')->middleware('auth')->middleware('is_admin');
//Route pour ajouter séance depuis admin
Route::get('/admin/ajout_seance', [AdminController::class, 'ajout_seanceForm'])->name('ajout_seanceform_admin')->middleware('auth')->middleware('is_admin');
Route::post('/admin/ajout_seance', [AdminController::class, 'ajout_seance'])->name('ajout_seance_admin')->middleware('auth')->middleware('is_admin');


//page pour l'étudiant
Route::view('/etudiant', 'home_etudiant')->name('etudiant_home')->middleware('auth');
//Route pour affecter les formations aux étudiants
Route::post('/admin/associer_formation', [AdminController::class, 'associer_formation'])->name('associer_formation')->middleware('auth')->middleware('is_admin');
//Route pour que l'étudiant s'inscrites
Route::get('/etudiant/inscription_etudiant', [EtudiantController::class, 'cour_etudiant_inscription_list'])->name('inscription_etudiant')->middleware('auth');
Route::post('/etudiant/inscription_etudiant', [EtudiantController::class, 'cour_etudiant_inscription_list'])->name('inscription_etudiant')->middleware('auth');
//Route pour afficher la liste des cours disponibles pour l'inscription
Route::get('/etudiant/cours/inscription', [EtudiantController::class, 'cour_etudiant_inscription_list'])->name('cour_etudiant_inscription_list')->middleware('auth');
//Route pour inscrire l'étudiant à un cours
Route::post('/etudiant/cours/inscription/{id}', [EtudiantController::class, 'cour_etudiant_inscription'])->name('cour_etudiant_inscription');
//Route pour désinscrire l'étudiant d'un cours
Route::post('/etudiant/cours/desinscription/{id}', [EtudiantController::class, 'cour_etudiant_desinscription'])->name('cour_etudiant_desinscription');
//Route pour recherche
Route::post('/rechercher_cours', [CourController::class, 'rechercher_cours'])->name('rechercher_cours');
Route::get('/rechercher_cours', [CourController::class, 'rechercher_cours'])->name('rechercher_cours');
//Route pour voir les séances
Route::get('/etudiant/seances_liste', [EtudiantController::class, 'liste_seance'])->name('liste_seance_etudiant')->middleware('auth');
//Route pour voir les options d'affichage de séances.
Route::get('/etudiant/seances_liste/cours_etudiant', [EtudiantController::class, 'liste_seance_cours_etudiant'])->name('liste_par_cours_etudiant')->middleware('auth');
Route::get('/etudiant/seances_liste/semaine_etudiant', [EtudiantController::class, 'liste_seance_semaine_etudiant'])->name('liste_par_semaine_etudiant')->middleware('auth');


//Page pour l'enseignant
Route::view('/enseignant', 'home_enseignant')->name('enseignant_home')->middleware('auth')->middleware('is_enseignant');
//Route pour voir les cours attribuer a l'enseignant
Route::get('/enseignant/liste_cours', [EnseignantController::class, 'liste_cours_enseignant'])->name('liste_cours')->middleware('auth')->middleware('is_enseignant');
//Route pour voir la liste des seances
Route::get('/enseignant/seances_liste', [EnseignantController::class, 'liste_seance'])->name('liste_seance')->middleware('auth')->middleware('is_enseignant');
//Route pour ajouter une seance
Route::get('/enseignant/ajout_seance/{id}', [EnseignantController::class, 'ajout_seanceForm'])->name('ajout_seanceform')->middleware('auth')->middleware('is_enseignant');
Route::post('/enseignant/ajout_seance/{id}', [EnseignantController::class, 'ajout_seance'])->name('ajout_seance')->middleware('auth')->middleware('is_enseignant');
//Route pour modifier une seance (date)
Route::get('/enseignant/modifier_seance/{id}', [EnseignantController::class, 'modif_seanceForm'])->name('modif_seanceform')->middleware('auth')->middleware('is_enseignant');
Route::post('/enseignant/modifier_seance/{id}', [EnseignantController::class, 'modif_seance'])->name('modif_seance')->middleware('auth')->middleware('is_enseignant');
//Route pour modifier une seance (cour)
Route::get('/enseignant/modifier_seance_cour/{id}', [EnseignantController::class, 'modif_seanceForm_cour'])->name('modif_seanceform_cour')->middleware('auth')->middleware('is_enseignant');
Route::post('/enseignant/modifier_seance_cour/{id}', [EnseignantController::class, 'modif_seance_cour'])->name('modif_seance_cour')->middleware('auth')->middleware('is_enseignant');
//Route pour supprimer une seance
Route::get('/enseignant/suprimerseance/{id}', [EnseignantController::class, 'suprimer_seanceForm'])->name('suprimer_seanceform')->middleware('auth')->middleware('is_enseignant');
Route::post('/enseignant/suprimerseance/{id}', [EnseignantController::class, 'suprimer_seances'])->name('suprimer_seances')->middleware('auth')->middleware('is_enseignant');
//Route pour voir les options d'affichage de séances.
Route::get('/enseignant/seances_liste/cours_enseignant', [EnseignantController::class, 'liste_seance_cours_enseignant'])->name('liste_par_cours_enseignant')->middleware('auth');
Route::get('/enseignant/seances_liste/semaine_enseignant', [EnseignantController::class, 'liste_seance_semaine_enseignant'])->name('liste_par_semaine_enseignant')->middleware('auth');






























