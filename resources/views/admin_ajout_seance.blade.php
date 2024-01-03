@extends('modele')

@section('contents')
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
                <h1 class="h3 mb-3 font-weight-normal">Ajouter une séance</h1>
                <form method="post" action="{{ route('ajout_seanceform_admin', ['id' => Auth::id()]) }}">
                    <div class="form-group">
                        <label for="cours_id">Cours</label>
                        <select name="cours_id" id="cours_id" class="form-control">
                            @foreach($cours_list as $cours)
                                <option value="{{$cours->id}}">{{$cours->intitule}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="enseignant_id">Enseignant</label>
                        <select name="enseignant_id" id="enseignant_id" class="form-control">
                            @foreach($enseignant_list as $enseignant)
                                <option
                                    value="{{$enseignant->id}}">{{$enseignant->nom}} {{$enseignant->prenom}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date_debut">Date de début</label>
                        <input type="date" class="form-control" id="date_debut" name="date_debut"
                               value="{{old('date_debut')}}">
                    </div>
                    <div class="form-group">
                        <label for="date_fin">Date de fin</label>
                        <input type="date" class="form-control" id="date_fin" name="date_fin"
                               value="{{old('date_fin')}}">
                    </div>
                    <br>
                    <button class="btn btn-lg btn-primary btn-block" type="submit" value="Envoyer">Ajouter</button>
                    <p class="mt-5 mb-3 text-muted">© 2023</p>
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
