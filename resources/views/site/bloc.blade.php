@extends('layouts.app')
@section('content')

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
            <tr class="trContentTh">
                <th>Image</th>
                <th>Couleur</th>
                <th>Difficulté</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

            @foreach($routesBloc as $routeBloc)
                @if($routeBloc->type_route == "B")
                    <tr class="trContentTh">
                        <td>
                            @if($routeBloc->color_route != null)
                                <img src="{{URL::asset('/img/'.$routeBloc->url_photo)}}" class="imgVoie"
                                     style="border: 3px solid {{$routeBloc->color_route}}">
                            @else
                                <img src="{{URL::asset('/img/'.$routeBloc->url_photo)}}" class="imgVoie">

                            @endif
                        </td>
                        <td><div class="colorVoie" style="background-color: {{$routeBloc->color_route}}"></div></td>
                        <td>
                            @if($routeBloc->difficulty_route != null)
                                {{$routeBloc->difficulty_route}}
                            @else
                                Pas de difficulté sur ce bloc
                            @endif

                        </td>
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
                                   href="{{route('add_validated_route',['idroom'=>$routeBloc->id_room,'id'=>$routeBloc->id_route])}}">Valider
                                    le
                                    bloc</a>
                            @endif
                        </td>
                    </tr>
                @endif
            @endforeach

            </tbody>
        </table>
    </div>

@endsection
