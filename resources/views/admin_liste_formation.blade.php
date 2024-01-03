@extends('modele')

@section('contents')

    <!--Liste des formations on peut modifier une formation en tant que admin ou ajouter un planning en tant que gestionnaire-->
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

    <h1 class="h3 mb-3 font-weight-normal">Liste des formations</h1>
    <br>

    <body class="text-center">
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Intitule</th>
            <th scope="col">Date d'ajout</th>
            <th scope="col">Date de modification</th>
            <th scope="col">Modification</th>
            <th scope="col">Suppression</th>
        </tr>
        </thead>
        <tbody>
        @foreach($formations as $formation)
            <tr>
                <td>{{$formation->intitule}}</td>
                <td>{{$formation->created_at}}</td>
                <td>{{$formation->updated_at}}</td>
                <td><a class="btn btn-dark" href="{{route('modif_formationform',['id'=>$formation->id])}}">Modifier</a>
                </td>
                <td><a class="btn btn-danger"
                       href="{{route('suprimer_formationform',['id'=>$formation->id])}}">Suprimer</a></td>


                @if(Auth::user()->type=="enseignant")
                    <td><a class="btn btn-dark"
                           href="{{route('ajout_planningform',['id'=>$formation->id])}}">Ajouter</a></td>
                @endif
            </tr>
        @endforeach

        </tbody>
    </table>
    </body>

@endsection
