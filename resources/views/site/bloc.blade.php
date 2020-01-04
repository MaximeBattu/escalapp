@extends('layouts.app')
@section('content')
    <h1>
        <a href="{{route('see_room',['id'=>$idRoute])}}">Retour</a>
    </h1>
    <div class="row justify-content-around">
        <div id="contest">
            <h2>Contest en cours</h2>
            <div id="close">x</div>
            <div id="ranking">
                <h1>Aucune voie n'a été validée pour l'instant</h1>
            </div>
            <div id="consult"><a href="">Consulter Contest</a></div>
        </div>
        <div id="open">></div>
        <table class="table container">
            <thead>
            <tr>
                <th>Image</th>
                <th>Difficulté</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @foreach($routesBloc as $routeBloc)
                @if($routeBloc->type_route == "B")
                    <tr>
                        <td>{{$routeBloc->url_photo}}</td>
                        <td>{{$routeBloc->color_route}}</td>
                        <td>
                            <a href="{{route('see_specific_route', ['idroom'=>$routeBloc->id_room,'id'=>$routeBloc->id_route])}}">Voir
                                le bloc</a>
                        </td>
                    </tr>
                @endif
            @endforeach

            </tbody>
        </table>
    </div>

@endsection
