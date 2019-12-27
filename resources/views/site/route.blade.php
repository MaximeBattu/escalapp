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

    @foreach($routes as $route)
        @if($route->type_route == "V")
        <tr>
            <td>{{$route->url_photo}}</td>
            <td>{{$route->color_route}}</td>
            <td>{{$route->difficulty_route}}</td>
            <td><a href="{{route('see_specific_routeBloc', ['id'=>$route->id_route])}}">Voir la voie</a></td>
        </tr>
        @endif

    @endforeach

    </tbody>

</table>

@endsection
