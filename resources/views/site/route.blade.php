@extends('layouts.app')
@section('content')

    <h1>
        <a href="{{route('see_room',['id'=>$id_room])}}">Retour</a>
    </h1>
    <div class="row justify-content-around">
        @if($voiesContest != null)
            <div id="contest">
                <h2>Contest en cours</h2>
                <div id="close">x</div>
                <div id="ranking">
                    @if($users != null)
                        @foreach($users as $user)
                            {{$user->name}}<br>
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
            <tr class="trContentTh">
                <th>Image</th>
                <th scope="col">Couleur</th>
                <th scope="col">Difficulté</th>
                <th scope="col"></th>
            </tr>
            </thead>
            <tbody>

            @foreach($routes as $route)
                @if($route->type_route == "V")
                    <tr class="trContentTh">
                        <td>
                            @if($route->color_route != null)
                                <img src="{{URL::asset('/img/'.$route->url_photo)}}" class="imgVoie"
                                     style="border: 3px solid {{$route->color_route}}">
                            @else
                                <img src="{{URL::asset('/img/'.$route->url_photo)}}" class="imgVoie">

                            @endif
                        </td>
                        <td>
                            <div class="colorVoie" style="background-color: {{$route->color_route}}"></div>
                        </td>
                        <td>{{$route->difficulty_route}}</td>
                        <td>
                            @if(isset($finishedRoute) && $finishedRoute->isNotEmpty())
                                @foreach($finishedRoute as $fr)
                                    @if($fr->id_user == Auth::user()->id)
                                        <p class="alert alert-success">
                                            Déjà validée
                                        </p>
                                    @endif
                                @endforeach
                            @else
                                <a class="btn btn-primary"
                                   href="{{route('add_validated_route',['idroom'=>$route->id_room,'id'=>$route->id_route])}}">Valider
                                    la
                                    voie</a>
                            @endif
                        </tr>
                    @endif
            @endforeach

            </tbody>
        </table>
    </div>

@endsection
