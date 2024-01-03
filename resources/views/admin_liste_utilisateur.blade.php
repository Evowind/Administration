<link href="principal.css" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--Liste des utilisateur on peut modifier,suprimer,accepter ou rechercher un utilisateur-->

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

    <h1 class="h3 mb-3 font-weight-normal">Liste des utilisateurs</h1>
    <br>

    <body class="text-center">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">Login</th>
            <th scope="col">Type</th>
            <th scope="col">Modification</th>
            <th scope="col">Supression</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{$user->nom}}</td>
                <td>{{$user->prenom}}</td>
                <td>{{$user->login}}</td>
                <td>{{$user->type}}</td>
                <td><a class="btn btn-dark" href="{{route('modif_usersform',['id'=>$user->id])}}">Modifier</a></td>
                @if ($user->type == 'admin' or $user->type == 'enseignant' or $user->type == 'etudiant')
                    <td><a class="btn btn-danger" href="{{route('suprimerform',['id'=>$user->id])}}">Suprimer</a></td>
                @endif

                @if ($user->type == '')
                    <td><a class="btn btn-danger" href="{{route('refuserform',['id'=>$user->id])}}">Refuser</a></td>
                @endif
                @if ($user->type == '')
                    <td><a class="btn btn-dark" href="{{route('accepterform',['id'=>$user->id])}}">Accepter</a></td>
                @endif
            </tr>
        @endforeach

        </tbody>
    </table>
    </body>

    <div class="card my-4">
        <h5 class="card-header">Rechercher</h5>
        <form class="card-body" action="{{route('rechercher_utilisateur_admin')}}" method="GET" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher" name="q">
                <div class="input-group-append">
                    <select class="form-control" name="type">
                        <option value="">Tous les types</option>
                        <option value="etudiant">Etudiant</option>
                        <option value="enseignant">Enseignant</option>
                    </select>
                </div>
                <div class="input-group-append">
                    <select class="form-control" name="nom_prenom_login">
                        <option value="">Tous les utilisateurs</option>
                        <option value="nom">Nom</option>
                        <option value="prenom">Prénom</option>
                        <option value="login">Login</option>
                    </select>
                </div>
                <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Rechercher</button>
            </span>
            </div>
        </form>
    </div>

@endsection
