<link href="home_user.css" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!--Permet de modifier son MDP-->

@extends('modele')

@section('contents')

    <h3></h3>
    <body class="text-center">
    <img class="mb-4" src="{{URL::asset('/images/image2.png')}}" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Modification du MDP</h1>

    <form action="{{route('modifmdp')}}" method="post">
        <div class="col-lg-3">
            <input type="password" class="form-control" placeholder="Nouveau MDP" name="newmdp">
            <input type="password" class="form-control" placeholder="Confirmation MDP" name="newmdp_confirmation">
        </div>
        <h2></h2>
        <button class="btn btn-lg btn-primary btn-block" type="submit" value="Envoyer">Modifier</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2023</p>
        @csrf
    </form>
    </body>

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
