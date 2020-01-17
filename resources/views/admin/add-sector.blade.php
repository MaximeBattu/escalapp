@extends('layouts.app')
@section('content')

    <h1 class="text-center">Ajoutez un secteur</h1>

    <form method="post" class="adding-room" action="{{route('add_sector',['id_room'=>$room_id])}}">
        {{csrf_field()}}
        <div class="form-group">
            <label for="name" class="label-adding-room">Nom</label>
            <input type="text" placeholder="Nom du secteur" class="form-control" name="name" required>

            <p class="label-adding-room">Type de voie</p>
        	<input type="radio" name="climbing_type" id="voie" value="V">
        	<label for="voie">Voie</label>
        	<input type="radio" name="climbing_type" id="bloc" value="B">
        	<label for="bloc">Bloc</label>
        </div>
        <button type="submit" class="btn button-shadow">Ajouter</button>
    </form>

@endsection