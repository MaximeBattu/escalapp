@extends('layouts.app')
@section('content')

    <div class="row justify-content-around">
        @if($voiesContest != null && $voiesContest->isNotEmpty())
            <div id="contest">
                <h2>Contest en cours</h2>
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
            <div id="closeContest">
                <div class="text-close">
                    <i class="fa fa-chevron-left"></i>
                </div>
            </div>
        @else
            <div id="contest">
                <h2>Contest en cours</h2>
                <div id="ranking">
                    <h1>Aucune voie n'a été validé pour l'instnant</h1>
                </div>
                <div id="consult"><a href="">Consulter Contest</a></div>
            </div>
            <div id="closeContest">
                <div class="text-close">
                    <i class="fa fa-chevron-left"></i>
                </div>
            </div>
        @endif
        <div id="open">
            <div class="text-renverse">
                CONTEST
            </div>
        </div>
        <div id="tableContent">
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
                    <tr class="text-center">
                        <td>
                            @if($routeBloc->color_route != null)
                                <img src="{{URL::asset('/img/'.$routeBloc->url_photo)}}" alt="" class="img" id="image"
                                     style="border:3px solid {{$routeBloc->color_route}}">
                            @else
                                <img src="{{URL::asset('/img/'.$routeBloc->url_photo)}}" alt="" class="img" id="image">
                            @endif
                        </td>
                        <td>
                            <div class="colorRoute" style="background-color: {{$routeBloc->color_route}}"></div>
                            {{$routeBloc->color_route}}
                        </td>
                        <td>{{$routeBloc->difficulty_route}}</td>
                        <td>
                            @if($routeBloc->finished)
                                <div class="d-inline-block">
                                    Déjà validée
                                </div>
                                <a class="btn btn-warning d-inline-block"
                                   href="{{route('delete_validated_route',['idroom'=>$room->id_room,'id'=>$routeBloc->id_route])}}">Retirer
                                    la
                                    voie</a>
                            @else
                                <a class="btn btn-primary d-inline-block"
                                   href="{{route('add_validated_route',['idroom'=>$room->id_room,'id'=>$routeBloc->id_route])}}">Valider
                                    la
                                    voie</a>
                        @endif
                    </td>
                    <td>
                        <div class="colorRoute" style="background-color: {{$routeBloc->color_route}}"></div>
                        {{$routeBloc->color_route}}
                    </td>
                    <td>{{$routeBloc->difficulty_route}}</td>
                    <td>
                        @if($routeBloc->finished)
                            <div class="d-inline-block">
                                Déjà validée
                            </div>
                            <a class="btn btn-warning d-inline-block"
                               href="{{route('delete_validated_route',['name_room'=>$room->name_room,'id'=>$routeBloc->id_route])}}">Retirer
                                la
                                voie</a>
                        @else
                            <a class="btn btn-primary d-inline-block"
                               href="{{route('validate_route',['name_room'=>$room->name_room,'id'=>$routeBloc->id_route])}}">Valider
                                la
                                voie</a>
                    @endif

                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
