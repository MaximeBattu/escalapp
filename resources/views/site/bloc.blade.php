@extends('layouts.app')
@section('content')
    <h1>
        <a href="{{route('see_room',['id'=>$idRoute])}}">Retour</a>
    </h1>
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

@endsection
