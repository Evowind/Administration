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
                <a class="btn btn-outline-dark my-sm-2" href="{{route('enseignant_home')}}" role="button">Tache
                    Enseignant</a>
            @endauth
        </form>
    </nav>
    <h1 class="h3 mb-3 font-weight-normal">Liste des cours</h1>
    <br>
    <!--Liste des cours on peut modifier un cours en tant que admin ou ajouter une seance en tant que gestionnaire-->

    <body class="text-center">
    </body>
    <br>
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Formation</th>
            <th scope="col">Intitulé</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cours as $cour)
            <tr>
                @if(isset($cour->formation))
                    <td>{{$cour->formation->intitule}}</td>
                @else
                    <td></td>
                @endif
                <td>{{$cour->intitule}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>

    <div class="card my-4">
        <h5 class="card-header">Rechercher</h5>
        <form class="card-body" action="{{route('search_cours')}}" method="GET" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher" name="q">
                <span class="input-group-btn">
            <button class="btn btn-secondary" type="submit">Rechercher</button>
          </span>
            </div>
        </form>
    </div>

@endsection
