@extends('modele')

<!--On choisis de refuser l'utilisateur avec oui ou annuler avec non-->

@section('contents')
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <body class="text-center">
    <img src="{{URL::asset('/images/sup.png')}}" width="100" height="100" class="img-fluid" alt="Image"><br>
    <h3>Suprimer cette utilisateur</h3>
    <form action="{{route('suprimer',['id'=>$user->id])}}" method="post">
        <input type="submit" class="btn btn-secondary btn-lg" value="Oui" name="submit">
        <input type="submit" class="btn btn-secondary btn-lg" value="Non" name="Submit">
        @csrf
    </form>
    </body>
@endsection
