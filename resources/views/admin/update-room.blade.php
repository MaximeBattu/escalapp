@extends('layouts.app')
@section('content')

    <form method="post" class="modify-room" action="{{route('update_room',['id'=>$room->id_room])}}">
        {{@csrf_field() }}
        <div class="form-group">
            <label for="" class="label-updating-room">Nom</label>
            <input type="text" value="{{$room->name_room}}" class="form-control" name="nameRoom" required>
            <label for="" class="label-updating-room">Adresse mail</label>
            <input type="email" value="{{$room->email}}" class="form-control" name="emailRoom" required>
            <label for="" class="label-updating-room">Adresse</label>
            <input type="text" value="{{$room->address_room}}" class="form-control" name="addressRoom" required>
        </div>

        <button type="submit" class="btn button-shadow" name="submit" value="Mettre à jour">Mettre à jour</button>
    </form>

@endsection
