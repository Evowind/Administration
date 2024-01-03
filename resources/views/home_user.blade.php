<link href="principal.css" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--Page de l'utilisateur ou il peut modifier don MDP ou modifier son nom-->

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
    <p>Bonjour {{ Auth::user()->nom}} {{ Auth::user()->prenom}} </p>

    <h1></h1>

    <div class="container">
        <div class="row">
            <div class="col">
                @auth
                    <img src="{{URL::asset('/images/Pencil.png')}}" width="100" height="100" class="img-fluid"
                         alt="Image"><br>
                    <p>Modifier le nom</p><br>
                    <div class="d-grid gap-2">
                        <a class="btn btn-lg btn-primary btn-block" href="{{route('modifnomform')}}" role="button">Modifier</a>
                    </div>
                @endauth
            </div>

            <div class="col">
                @auth
                    <img src="{{URL::asset('/images/Lock.png')}}" width="100" height="100" class="img-fluid"
                         alt="Image"><br>
                    <p>Modifier le MDP</p><br>
                    <div class="d-grid gap-2">
                        <a class="btn btn-lg btn-primary btn-block" href="{{route('modifmdpform')}}" role="button">Modifier</a>
                    </div>
                @endauth
            </div>

@endsection
