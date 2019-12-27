@extends('layouts.app')
@section('content')

    <h1>
        <a href="{{route('see_room_management')}}">Retour</a>
    </h1>

    <form method="post" class="modify-room" action="{{route('update_room',['id'=>$room->id_room])}}">
        {{@csrf_field() }}
        <div class="form-group">
            <label for="" class="label-updating-room">Nom</label>
            <input type="text" value="{{$room->name_room}}" class="form-control" name="nameRoom">
            <label for="" class="label-updating-room">Numéro de téléphone</label>
            <input type="text" value="{{$room->tel_room}}" class="form-control" name="numberphoneRoom">
            <label for="" class="label-updating-room">Adresse</label>
            <input type="text" value="{{$room->address_room}}" class="form-control" name="addressRoom">
        </div>

        <button type="submit" class="btn btn-primary" name="submit" value="Mettre à jour">Mettre à jour</button>
    </form>

@endsection
