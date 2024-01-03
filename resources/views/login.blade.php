<link href="home_user.css" rel="stylesheet">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

@extends('modele')

<!-- Page de connexion -->

@section('contents')

    <h3></h3>
    <body class="text-center">
    <img class="mb-4" src="{{URL::asset('/images/image2.png')}}" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Connexion</h1>

    <form method="post" route="/login">
        <div class="col-lg-3">
            <input type="text" class="form-control" placeholder="Login" name="login" value="{{old('login')}}">
            <input type="password" class="form-control" placeholder="MDP" name="mdp">
        </div>
        <h2></h2>
        <button class="btn btn-lg btn-primary btn-block" type="submit" value="Envoyer">Connexion</button>
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
