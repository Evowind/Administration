<link href="ajout_user.css" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--Permet de modifier un étudiant en rentrant ses informations-->

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
                <a class="btn btn-outline-dark my-sm-2" href="{{route('enseignant_home')}}" role="button">Tâches
                    Enseignant</a>
            @endauth
        </form>
    </nav>

    <br>
    <br>
    <br>
    <br>

    <body class="text-center">
    <img class="mb-4" src="{{URL::asset('/images/image2.png')}}" alt="" width="72" height="72">
    <div class="container">
        <div class="row">
            <div class="col">
            </div>
            <div class="col">
                <h1 class="h3 mb-3 font-weight-normal">Modifier une séance</h1>

                <form action="{{route('modif_seance_cour',['id'=>$seances->id])}}" method="post">
                    <div class="col-lg-12">
                        <select class="form-control" name="cours">
                            @foreach($cours as $cour)
                                <option value="{{$cour->id}}"
                                        @if($seances->cours_id == $cour->id) selected @endif>{{$cour->intitule}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" value="Modifier">Modifier</button>
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
