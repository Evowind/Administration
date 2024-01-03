<link href="ajout_user.css" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--Permet d'acepter un utilisateur et de choisir son type-->
@extends('modele')

@section('contents')

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
                <h1 class="h3 mb-3 font-weight-normal">Accepter un etudiant</h1>

                <form action="{{route('accepter',['id'=>$user->id])}}" method="post">
                    <div class="col-lg-12">
                        <p>Sélectionner le type :</p>
                        <select name="type" id="type" class="form-control">
                            <option value="enseignant">enseignant</option>
                            <option value="etudiant">etudiant</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>
                    <h2></h2>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" value="Modifier">Modifier</button>
                    <p class="mt-5 mb-3 text-muted">&copy; 2023</p>
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
