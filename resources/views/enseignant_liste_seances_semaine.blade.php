@extends('modele')

@section('contents')
    <nav class="navbar navbar-light bg-white">
        <a class="navbar-brand" href="">
            <img src="{{URL::asset('/images/image2.png')}}" width="30" height="30" class="d-inline-block align-top"
                 alt="Image">
            Projet
        </a>
        <form class="form-inline my-2 my-lg-0">
            <a class="btn btn-outline-dark my-sm-2" href="{{route('liste_par_cours_enseignant')}}" role="button">Par
                Cours</a>
            <a class="btn btn-outline-dark my-sm-2" href="{{route('liste_par_semaine_enseignant')}}" role="button">Par
                Semaine</a>
            @auth
                @if (Auth::user()->type == 'admin')
                    <a class="btn btn-outline-dark my-sm-2" href="{{route('admin_home')}}" role="button">Tache Admin</a>
                @endif
            @endauth
            @auth
                @if (Auth::user()->type == 'etudiant')
                    <a class="btn btn-outline-dark my-sm-2" href="{{route('etudiant_home')}}" role="button">Tache
                        Etudiant</a>
                @endif
            @endauth
            @auth
                @if (Auth::user()->type == 'enseignant')
                    <a class="btn btn-outline-dark my-sm-2" href="{{route('enseignant_home')}}"
                       role="button">Tache Enseignant</a>
                @endif
            @endauth
            @auth
                <a class="btn btn-primary my-sm-0" href="{{route('logout')}}" role="button">Deconnexion</a>
            @endauth
        </form>
    </nav>
    <h1 class="h3 mb-3 font-weight-normal">Liste des séances par semaine (52)</h1>
    <br>
    <body class="text-center">
    <table class="table table-striped">
        <tbody>
        @foreach($seances_par_semaine as $semaine => $plannings)
            <tr>
                <td colspan="3" class="font-weight-bold">Semaine {{ $semaine }}</td>
            </tr>
            @foreach($plannings as $seance)
                <tr>
                    <td>{{ $seance['cour']->intitule }}</td>
                    <td>{{ $seance['seance']->date_debut }}</td>
                    <td>{{ $seance['seance']->date_fin }}</td>
                </tr>
            @endforeach
        @endforeach
        </tbody>
    </table>

@endsection
