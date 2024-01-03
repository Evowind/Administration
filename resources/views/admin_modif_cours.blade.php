<link href="ajout_user.css" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--Permet de modifier un cours en rentrant son intitule-->

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
                <h1 class="h3 mb-3 font-weight-normal">Modifier un cours</h1>
                <br>

                <form action="{{route('modif_cours',['id'=>$cours->id])}}" method="post">
                    <div class="col-lg-12">
                        <input type="text" class="form-control" placeholder="Intitule" name="intitule"
                               value="{{$cours->intitule}}">
                    </div>
                    <br>
                    <div class="col-lg-12">
                        <label for="formation_id">Formation:</label>
                        <select class="form-control" id="formation_id" name="formation_id">
                            <option value="">-- Choisissez une formation --</option>
                            @foreach($formations as $formation)
                                <option
                                    value="{{$formation->id}}" {{$cours->formation_id == $formation->id ? 'selected' : ''}}>{{$formation->intitule}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" value="Modifier">Modifier</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 3</p>
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
