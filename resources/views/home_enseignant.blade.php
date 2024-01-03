<link href="principal.css" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--Page du gestionnaire ou il peut faire differentes actions-->

@extends('modele')

<nav class="navbar navbar-light bg-white">
    <a class="navbar-brand" href="">
        <img src="{{URL::asset('/images/image2.png')}}" width="30" height="30" class="d-inline-block align-top"
             alt="Image">
        Projet
    </a>
    <form class="form-inline my-2 my-lg-0">
        @auth
            <a class="btn btn-primary my-sm-0" href="{{route('logout')}}" role="button">Deconnexion</a>
        @endauth
    </form>
</nav>
<p>Enseignant</p>
<br>
<h1></h1>
<div class="container">
    <br>
    <br>
    <br>
    <div class="row align-items-end">


        <div class="col">
            @auth
                <img src="{{URL::asset('/images/cours_enseignant.png')}}" width="100" height="100" class="img-fluid"
                     alt="Image"><br>
                <p>Liste de cours</p><br>
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-primary btn-block" href="{{route('liste_cours')}}"
                       role="button">Parcourir</a>
                </div>
            @endauth
        </div>
        <div class="col">
            @auth
                <img src="{{URL::asset('/images/seance.png')}}" width="100" height="100" class="img-fluid" alt="Image">
                <br>
                <p>Liste des seances</p><br>
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-primary btn-block" href="{{route('liste_seance')}}" role="button">Liste</a>
                </div>
            @endauth
        </div>
        <div class="col">
            @auth
                <img src="{{URL::asset('/images/seance.png')}}" width="100" height="100" class="img-fluid" alt="Image">
                <br>
                <p>Ajouter des seances</p><br>
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-primary btn-block"
                       href="{{ route('ajout_seanceform', ['id' => Auth::id()]) }}" role="button">Ajouter</a>
                </div>
            @endauth
        </div>
    </div>
</div>


@section('contents')

@endsection
