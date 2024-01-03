<link href="principal.css" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--Page de l'admin ou il peut faire differentes actions-->

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
<p>Admin</p>

<!-- Ajouter des choses -->
<h1></h1>
</div>
<div class="container">
    <div class="row align-items-end">
        <div class="col">
            @auth
                <img src="{{URL::asset('/images/utilisateur_plus.png')}}" width="100" height="100" class="img-fluid"
                     alt="Image"><br>
                <p>Ajouter une séance</p><br>
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-primary btn-block" href="{{route('ajout_seanceform_admin')}}"
                       role="button">Ajouter</a>
                </div>
            @endauth
        </div>
        <div class="col">
            @auth
                <img src="{{URL::asset('/images/cours_plus.png')}}" width="100" height="100" class="img-fluid"
                     alt="Image"><br>
                <p>Ajouter un cours</p><br>
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-primary btn-block" href="{{route('ajout_coursform')}}" role="button">Ajouter</a>
                </div>
            @endauth
        </div>
        <div class="col">
            @auth
                <img src="{{URL::asset('/images/cours_enseignant.png')}}" width="100" height="100" class="img-fluid"
                     alt="Image"><br>
                <p>Ajouter formation</p><br>
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-primary btn-block" href="{{route('ajout_formationform')}}" role="button">Ajouter</a>
                </div>
            @endauth
        </div>
        <div class="col">
            @auth
                <img src="{{URL::asset('/images/cours_enseignant.png')}}" width="100" height="100" class="img-fluid"
                     alt="Image"><br>
                <p>Affecter cours/ens.</p><br>
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-primary btn-block" href="{{route('associer_cours_admin')}}" role="button">Affecter</a>
                </div>
            @endauth
        </div>
    </div>
</div>

<br>

<!-- Lister des choses -->
<div class="container">
    <div class="row align-items-end">
        <div class="col">
            @auth
                <img src="{{URL::asset('/images/utilisateur.png')}}" width="100" height="100" class="img-fluid"
                     alt="Image"><br>
                <p>Liste des utilisateurs</p><br>
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-primary btn-block" href="{{route('liste_utilisateur')}}" role="button">Liste</a>
                </div>
            @endauth
        </div>
        <div class="col">
            @auth
                <img src="{{URL::asset('/images/cours.png')}}" width="100" height="100" class="img-fluid" alt="Image">
                <br>
                <p>Liste des cours</p><br>
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-primary btn-block" href="{{route('liste_cours_admin')}}" role="button">Liste</a>
                </div>
            @endauth
        </div>
        <div class="col">
            @auth
                <img src="{{URL::asset('/images/cours_enseignant.png')}}" width="100" height="100" class="img-fluid"
                     alt="Image"><br>
                <p>Lister formation</p><br>
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-primary btn-block" href="{{route('liste_formation')}}"
                       role="button">Liste</a>
                </div>
            @endauth
        </div>
        <div class="col">
            @auth
                <img src="{{URL::asset('/images/cours_enseignant.png')}}" width="100" height="100" class="img-fluid"
                     alt="Image"><br>
                <p>Affecter etu./formation</p><br>
                <div class="d-grid gap-2">
                    <a class="btn btn-lg btn-primary btn-block" href="{{route('associer_formation')}}" role="button">Affecter</a>
                </div>
            @endauth
        </div>

    </div>



@section('contents')

@endsection
