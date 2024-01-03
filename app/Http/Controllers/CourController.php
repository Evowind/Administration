<?php

namespace App\Http\Controllers;

use App\Models\Cour;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CourController extends Controller
{
    public function rechercher_cours(Request $request)
    {
        $intitule = $request->input('intitule');

        // Search for courses that match the input value and are in the formation of the current user
        $cours = Cour::where('intitule', 'LIKE', '%' . $intitule . '%')
            ->whereHas('formation', function ($query) {
                $query->where('id', '=', Auth::user()->formation_id);
            })
            ->get();

        // Get the list of courses the student is already enrolled in
        $coursInscrits = Auth::user()->cours;

        // Pass the courses and enrolled courses to the view
        return view('etudiant_inscription', compact('cours', 'coursInscrits'));
    }

    public function rechercher_cours_admin(Request $request)
    {
        $intitule = $request->input('q');

        // Search for courses that match the input value
        $cours = Cour::where('intitule', 'LIKE', '%' . $intitule . '%')->get();

        // Pass the courses to the view
        return view('admin_liste_cours_admin', compact('cours'));
    }


}

