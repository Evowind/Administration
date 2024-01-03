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
                <a class="btn btn-outline-dark my-sm-2" href="{{route('admin_home')}}" role="button">
                    Tache Admin</a>
            @endauth
        </form>
    </nav>
    <body class="text-center">
    <h1>Affectation des formations aux étudiants</h1>
    <form method="POST" action="{{ route('associer_formation') }}">
        @csrf
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Login</th>
                <th>Formation</th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->nom }}</td>
                    <td>{{ $user->prenom }}</td>
                    <td>{{ $user->login }}</td>
                    <td>
                        <select name="formations[{{ $user->id }}]">
                            <option value="">Choisir une formation</option>
                            @foreach($formations as $formation)
                                <option
                                    value="{{ $formation->id }}" {{ $user->formation_id == $formation->id ? 'selected' : '' }}>{{ $formation->intitule }}</option>
                            @endforeach
                        </select>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <button type="submit" class="btn btn-primary">Enregistrer</button>
    </form>
    </div>
@endsection
