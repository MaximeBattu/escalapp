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
            <input type="text" placeholder="Nom de la salle" class="form-control" name="nameRoom" required>

            <label for="emailRoom" class="label-adding-room">E-mail</label>
            <input  type="email" placeholder="E-mail de la salle" class="form-control" name="emailRoom" required>

            <label for="addressRoom" class="label-adding-room">Adresse</label>
            <input type="text" placeholder="Adresse de la salle" class="form-control" name="addressRoom" required>
        </div>

        <button type="submit" class="btn btn-primary" name="submit" value="Ajouter et recommencer">Ajouter et
            recommencer
        </button>
        <button type="submit" class="btn btn-primary" name="submit" value="Ajouter">Ajouter</button>
    </form>

    <div>
        @if(\Session::has('add-success'))
            <div class="alert alert-success" id="addSuccessRoom">
                {{\Session::get('add-success')}}
            </div>
        @endif
    </div>
@endsection
