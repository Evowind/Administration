<link href="home.css" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

@extends('modele')

<!-- Page d'accueil du projet -->
<!-- On trouve les liens pour se connecter ou créer un compte -->
@section('contents')
    <nav class="navbar navbar-light bg-white">
        <a class="navbar-brand" href="">
            <img src="{{URL::asset('/images/image2.png')}}" width="30" height="30" class="d-inline-block align-top"
                 alt="Image">
            Projet
        </a>
        <form class="form-inline my-2 my-lg-0">
            @guest()
                <a class="btn btn-outline-primary my-sm-2" href="{{route('login')}}" role="button">Connexion</a>
                <a class="btn btn-primary my-sm-0" href="{{route('register')}}" role="button">Créer un compte</a>
            @endguest
        </form>
    </nav>
    <p>Page d' accueil</p>
    <img src="{{URL::asset('/images/image1.png')}}" class="img-fluid" alt="Image">
@endsection
