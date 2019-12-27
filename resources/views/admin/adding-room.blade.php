@extends('layouts.app')
@section('content')

    <h1>
        <a href="{{route('see_room_management')}}">Retour</a>
    </h1>

    <h1 class="text-center">Ajoutez une ou plusieurs salles</h1>

    <form method="post" class="adding-room" action="{{route('add_room')}}">
        {{csrf_field()}}
        <div class="form-group">
            <label for="nameRoom" class="label-adding-room">Nom</label>
            <input type="text" value="nom" class="form-control" name="nameRoom">

            <label for="numberphoneRoom" class="label-adding-room">Numéro de téléphone</label>
            <input type="text" class="form-control" name="numberphoneRoom">

            <label for="addressRoom" class="label-adding-room">Adresse</label>
            <input type="text" class="form-control" name="addressRoom">
        </div>

        <button type="submit" class="btn btn-primary" name="submit" value="Ajouter et recommencer">Ajouter et
            recommencer
        </button>
        <button type="submit" class="btn btn-primary" name="submit" value="Ajouter">Ajouter</button>
    </form>

    <div>
        @if(\Session::has('add-success'))
            <div class="alert alert-success" id="add-success">
                {{\Session::get('add-success')}}
            </div>
        @endif
    </div>
@endsection
