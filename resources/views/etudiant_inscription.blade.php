@extends('modele')

@section('contents')
    <nav class="navbar navbar-light bg-white">
        <a class="navbar-brand" href="">
            <img src="{{URL::asset('/images/image2.png')}}" width="30" height="30" class="d-inline-block align-top"
                 alt="Image">
            Projet
        </a>
        <form class="form-inline my-2 my-lg-0">
            @auth
                <a class="btn btn-outline-dark my-sm-2" href="{{route('etudiant_home')}}" role="button">Tache
                    Etudiant</a>
            @endauth
        </form>
    </nav>
    <h1 class="h3 mb-3 font-weight-normal">Cours disponibles</h1>
    <br>

    <body class="text-center">
    </body>
    <br>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Intitulé</th>
            <th>Enseignant</th>
            <th>Formation</th>
            <th>Inscription</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($cours as $cour)
            <tr>
                <td>{{ $cour->intitule }}</td>
                <td>
                    @if ($cour->user->id == 1)
                        Enseignant non assigné
                    @else
                        {{ $cour->user->nom }} {{ $cour->user->prenom }}
                    @endif
                </td>
                <td>{{ $cour->formation->intitule }}</td>
                <td>
                    @if ($coursInscrits->contains($cour))
                        <form action="{{ route('cour_etudiant_desinscription', $cour->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-danger">Désinscrire</button>
                        </form>
                    @else
                        <form action="{{ route('cour_etudiant_inscription', $cour->id) }}" method="POST">
                            @csrf
                            <button class="btn btn-primary">S'inscrire</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    <div class="card my-4">
        <h5 class="card-header">Rechercher</h5>
        <form class="card-body" action="{{ route('rechercher_cours') }}" method="POST" role="search">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" id="inputRecherche" name="intitule">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-secondary">Rechercher</button>

        </span>
            </div>
        </form>
    </div>

@endsection
