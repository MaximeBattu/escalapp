@extends('layouts.app')
@section('content')

    <div class="row justify-content-around">
        @if($voiesContest != null && $voiesContest->isNotEmpty())
            <div id="contest">
                <h2>Contest en cours</h2>
                <div id="close">x</div>
                <div id="ranking">
                    @if($users !== null && $users->isNotEmpty())
                        @foreach($users as $user)
                            {{$user->name}}
                        @endforeach
                    @else
                        <h1>Aucune voie n'a été validée pour l'instant</h1>
                    @endif
                </div>
                <div id="consult"><a href="">Consulter Contest</a></div>
            </div>
        @else
            <div id="contest">
                <h2>Contest en cours</h2>
                <div id="close">x</div>
                <div id="ranking">
                    <h1>Aucune voie n'a été validé pour l'instnant</h1>
                </div>
                <div id="consult"><a href="">Consulter Contest</a></div>
            </div>
        @endif
        <div id="open">></div>
        <table class="table table- container" style="width: 80vw;">
            <thead>
            <tr class="text-center">
                <th>Image</th>
                <th scope="col">Couleur</th>
                <th scope="col">Difficulté</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>

            @foreach($routes as $route)
                <tr class="text-center">
                    <td>
                        @if($route->color_route != null)
                            <img src="{{URL::asset('/img/'.$route->url_photo)}}" alt="" class="img" id="image"
                                 style="border:3px solid {{$route->color_route}}">
                        @else
                            <img src="{{URL::asset('/img/'.$route->url_photo)}}" alt="" class="img" id="image">
                        @endif
                    </td>
                    <td>
                        <div class="colorRoute" style="background-color: {{$route->color_route}}"></div>
                        {{$route->color_route}}
                    </td>
                    <td>{{$route->difficulty_route}}</td>
                    <td>
                        @if($route->finished)
                            <div class="d-inline-block">
                                    Déjà validée
                            </div>
                            <a class="btn btn-warning d-inline-block"
                               href="{{route('delete_validated_route',['name_room'=>$room->name_room,'id'=>$route->id_route])}}">Retirer
                                la
                                voie</a>
                        @else
                            <a class="btn btn-primary d-inline-block"
                               href="{{route('validate_route',['name_room'=>$room->name_room,'id'=>$route->id_route])}}">Valider
                                la
                                voie</a>
                        @endif
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>

@endsection
