<link href="ajout_user.css" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--Permet de modifier un utilisateur en rentrant ses informations-->

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
                <a class="btn btn-outline-dark my-sm-2" href="{{route('admin_home')}}" role="button">Tache
                    Admin</a>
            @endauth
        </form>
    </nav>

    <br>
    <br>
    <body class="text-center">
    <img class="mb-4" src="{{URL::asset('/images/image2.png')}}" alt="" width="72" height="72">
    <div class="container">
        <div class="row">
            <div class="col">
            </div>
            <div class="col">
                <h1 class="h3 mb-3 font-weight-normal">Associer un cours à un enseignant.</h1>

                <form method="POST" action="{{ route('associer_cours') }}">
                    @csrf

                    <div class="form-group">
                        <label for="id_cours">Sélectionnez un cours :</label>
                        <select id="id_cours" name="id_cours" class="form-control">
                            @foreach ($cours as $cour)
                                <option value="{{ $cour->id }}">{{ $cour->intitule }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="id_enseignant">Sélectionnez un enseignant :</label>
                        <select id="id_enseignant" name="id_enseignant" class="form-control">
                            @foreach ($enseignants as $enseignant)
                                <option value="{{ $enseignant->id }}">{{ $enseignant->nom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary">Associer</button>

                    <p class="mt-3 mb-3 text-muted">&copy; 2023</p>
                    @csrf
                </form>
    </body>
    </div>

    <div class="col">
    </div>

    @if ($errors->any())
        <div class="error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection
