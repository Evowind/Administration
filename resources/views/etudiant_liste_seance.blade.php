@extends('modele')

@section('contents')
    <nav class="navbar navbar-light bg-white">
        <a class="navbar-brand" href="">
            <img src="{{URL::asset('/images/image2.png')}}" width="30" height="30" class="d-inline-block align-top"
                 alt="Image">
            Projet
        </a>
        <form class="form-inline my-2 my-lg-0">
            <a class="btn btn-outline-dark my-sm-2" href="{{route('liste_par_cours_etudiant')}}" role="button">Par
                Cours</a>
            <a class="btn btn-outline-dark my-sm-2" href="{{route('liste_par_semaine_etudiant')}}" role="button">Par
                Semaine</a>
            @auth
                @if (Auth::user()->type == 'admin')
                    <a class="btn btn-outline-dark my-sm-2" href="{{route('admin_home')}}" role="button">Tache Admin</a>
                @endif
            @endauth
            @auth
                @if (Auth::user()->type == 'etudiant')
                    <a class="btn btn-outline-dark my-sm-2" href="{{route('etudiant_home')}}" role="button">Tache
                        Étudiant</a>
                @endif
            @endauth
            @auth
                @if (Auth::user()->type == 'enseignant')
                    <a class="btn btn-outline-dark my-sm-2" href="{{route('enseignant_home')}}"
                       role="button">Tache Enseignant</a>
                @endif
            @endauth
            @auth
                <a class="btn btn-primary my-sm-0" href="{{route('logout')}}" role="button">Déconnexion</a>
            @endauth
        </form>
    </nav>

    <!--Liste des seances-->

    <h1 class="h3 mb-3 font-weight-normal">Liste des seances</h1>
    <br>

    <body class="text-center">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Intitulé</th>
            <th scope="col">Date de début</th>
            <th scope="col">Date de fin</th>

        </tr>
        </thead>
        <tbody>
        @foreach($seances as $planning)
            <tr>
                <td>{{$planning->cours->intitule}}</td>
                <td>{{$planning->date_debut}}</td>
                <td>{{$planning->date_fin}}</td>
        @endforeach


        </tbody>
    </table>
    </body>

@endsection


