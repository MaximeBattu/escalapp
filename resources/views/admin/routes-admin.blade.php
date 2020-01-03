@extends('layouts.app')
@section('content')

    <h1>
        <a href="{{route('see_room_management')}}">Gestion salles</a>
    </h1>
    <h1 class="text-center">Toutes les voies de la salle : {{$room->name_room}}</h1>
    <div>
        <a type="button" class="btn btn-success add-route" href="{{route('see_add_routes',['id'=>$room->id_room])}}">Ajouter une voie</a>
    </div>
    <table class="table salles-admin">
        <thead>
        <tr class="d-flex">
            <th class="col-md-1">ID</th>
            <th class="col-md-1">Couleur</th>
            <th class="col-md-2">Difficulté</th>
            <th class="col-md-2">Type de voie</th>
            <th class="col-md-2">Score</th>
            <th class="col-md-2">Dernière mise à jour</th>
            <th colspan="2" class="col-md-2 room-change">Changement</th>
        </tr>
        </thead>
        <tbody>
        @foreach($routes as $route)
            <tr class="d-flex">
                <td class="col-md-1"> {{$route->id_route}}</td>
                @if($route->type_route == "V")
                    <td class="col-md-1">{{$route->color_route}}</td>
                    <td class="col-md-2">{{$route->difficulty_route}}</td>
                    <td class="col-md-2">Voie</td>
                @else
                    <td class="col-md-1"></td>
                    <td class="col-md-2">{{$route->color_route}}</td>
                    <td class="col-md-2">Bloc</td>
                @endif
                <td class="col-md-2">{{$route->score_route}}</td>
                @if(isset($route->updated_at))
                    <td class="col-md-2">{{$route->updated_at->format('d/m/yy')}}</td>
                @else
                    <td class="col-md-2">Aucune mise à jour</td>
                @endif
                <td class="col-md-1 room-change">
                    <a type="button" class="btn btn-warning" href="{{route('modify_route',['id'=>$room->id_room,'idroute'=>$route->id_route])}}">Modifier</a>
                </td>
                <td class="col-md-1 room-change">
                    <a type="button" class="btn btn-danger" href="{{route('delete_route',['id'=>$room->id_room,'idroute'=>$route->id_route])}}">Supprimer</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
