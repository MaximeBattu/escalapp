@extends('layouts.app')
@section('content')

    <table class="table table- container" style="width: 80vw;">
        <thead>
        <tr>
            <th>Image</th>
            <th scope="col">Couleur</th>
            <th scope="col">Difficulté</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>


        @foreach($routesBloc as $routeBloc)
            @if($routeBloc->type_route == "B")
                <tr>
                    <td>{{$routeBloc->url_photo}}</td>
                    <td>{{$routeBloc->color_route}}</td>
                    <td>{{$routeBloc->difficulty_route}}</td>
                    <td><a href="{{route('see_specific_routeBloc', ['id'=>$routeBloc->id_route])}}">Voir le bloc</a>
                    </td>
                </tr>
            @endif
        @endforeach


        </tbody>

    </table>

@endsection
