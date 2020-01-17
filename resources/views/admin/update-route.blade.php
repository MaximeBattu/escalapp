@extends('layouts.app')
@section('content')

    <form method="post" class="modify-route" action="{{route('update_route',['id'=>$sector->id_room,'idsector'=>$sector->id_sector,'idroute'=>$route->id_route])}}">
        {{@csrf_field() }}
        <div class="form-group">
            <label for="" class="label-updating-room">Couleur</label>
            <select name="colorRouteSelect" id="" required>
                <option selected>{{$route->color_route}}</option>
                <option value="red">Rouge</option>
                <option value="brown">Marron</option>
                <option value="blue">Bleue</option>
                <option value="yellow">Jaune</option>
                <option value="grey">Grise</option>
            </select>
            <br>
            <label for="" class="label-updating-room">Difficulté</label>
            <select name="difficultySelect">
                <option selected>{{$route->difficulty_route}}</option>
                <option value="3">3</option>
                <option value="3+">3+</option>
                <option value="4a">4a</option>
                <option value="4b">4b</option>
                <option value="4c">4c</option>
                <option value="5a">5a</option>
                <option value="5b">5b</option>
                <option value="5c">5c</option>
                <option value="6a">6a</option>
                <option value="6a+">6a+</option>
                <option value="6b">6b</option>
                <option value="6b+">6b+</option>
                <option value="6c">6c</option>
                <option value="6c+">6c+</option>
                <option value="7a">7a</option>
                <option value="7a+">7a+</option>
                <option value="7b">7b</option>
                <option value="7b+">7b+</option>
                <option value="7c">7c</option>
                <option value="7c+">7c+</option>
                <option value="8a">8a</option>
                <option value="8a+">8a+</option>
                <option value="8b">8b</option>
                <option value="8b+">8b+</option>
                <option value="8c">8c</option>
                <option value="8c+">8c+</option>
                <option value="9a">9a</option>
                <option value="9a+">9a+</option>
            </select>
            <br>

            <label for="" class="label-updating-room">Ajouter une photo</label>
            <input type="text" placeholder="Url de l'image " class="form-control" name="urlPhotoRoute"
                   value="{{$route->url_photo}}">
        </div>

        <button type="submit" class="btn button-shadow" name="submit" value="Mettre à jour">Mettre à jour</button>
    </form>

@endsection
