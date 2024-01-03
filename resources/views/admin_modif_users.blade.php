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
                <h1 class="h3 mb-3 font-weight-normal">Modifier un utilisateur</h1>

                <form action="{{route('modif_users',['id'=>$users->id])}}" method="post">
                    <div class="col-lg-12">
                        <input type="text" class="form-control" placeholder="Nom" name="nom" value="{{$users->nom}}">
                        <input type="text" class="form-control" placeholder="Prenom" name="prenom"
                               value="{{$users->prenom}}">
                        <input type="text" class="form-control" placeholder="Login" name="login">
                        <input type="password" class="form-control" placeholder="MDP" name="mdp">
                        <input type="password" class="form-control" placeholder="Confirmation MDP"
                               name="mdp_confirmation">
                        <p>Sélectionner le type :</p>
                        <select name="type" id="type" class="form-control" placeholder="Type">
                            <option value="enseignant">enseignant</option>
                            <option value="etudiant">etudiant</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>
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
