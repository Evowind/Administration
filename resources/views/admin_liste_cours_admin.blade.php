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
    <!--Liste des cours on peut modifier un cours en tant que admin ou ajouter une seance en tant que gestionnaire-->

    <h1 class="h3 mb-3 font-weight-normal">Liste des cours</h1>
    <br>

    <body class="text-center">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Enseignant</th>
            <th scope="col">Formation</th>
            <th scope="col">Intitule</th>
            <th scope="col">Date d'ajout</th>
            <th scope="col">Date de modification</th>
            <th scope="col">Modification</th>
            <th scope="col">Supression</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cours as $cour)
            <tr>
                @if($cour->user_id == 1)
                    <td>Non défini</td>
                @else
                    <td>{{$cour->user->nom}} {{$cour->user->prenom}}</td>
                @endif
                @if(isset($cour->formation))
                    <td>{{$cour->formation->intitule}}</td>
                @else
                    <td></td>
                @endif
                <td>{{$cour->intitule}}</td>
                <td>{{$cour->created_at}}</td>
                <td>{{$cour->updated_at}}</td>
                <td><a class="btn btn-dark" href="{{route('modif_coursform',['id'=>$cour->id])}}">Modifier</a></td>
                <td><a class="btn btn-danger" href="{{route('suprimer_coursform',['id'=>$cour->id])}}">Suprimer</a></td>
            </tr>
        @endforeach


        </tbody>
    </table>
    </body>
    </table>
    </body>

    <div class="card my-4">
        <h5 class="card-header">Rechercher</h5>
        <form class="card-body" action="{{route('rechercher_cours_admin')}}" method="GET">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher par intitulé" name="q">
                <span class="input-group-btn">
                <button class="btn btn-secondary" type="submit">Rechercher</button>
            </span>
            </div>
        </form>
    </div>

@endsection
