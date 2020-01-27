@extends('layouts.app')
@section('content')

    <div class="row justify-content-around">
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
        <div id="open">
            <div class="text-renverse">
                CONTEST
            </div>
        </div>
        <div id="tableContent">
            <table class="table">
                <tbody>
                @foreach($routesBloc as $routeBloc)
                    <tr class="text-center">
                        <td class="align-middle table-text">
                            @if($routeBloc->color_route != null)
                                    <img src="{{URL::asset('/img/'.$routeBloc->url_photo)}}" alt="" class="img"
                                         id="image"
                                         style="border:6px solid {{$routeBloc->color_route}};">

                            @else
                                <img src="{{URL::asset('/img/'.$routeBloc->url_photo)}}" alt="" class="img" id="image">
                            @endif
                        </td>
                        <td class="align-middle table-text">{{$routeBloc->difficulty_route}}</td>
                        <td class="align-middle table-text">{{$routeBloc->score_route}} pts</td>
                        <td class="align-middle table-text">
                            @if($routeBloc->finished)
                                <a class="fa fa-check fa-2x finished-check"
                                   href="{{route('delete_validated_route',['name_room'=>$room->name_room,'id'=>$routeBloc->id_route])}}"></a>
                            @else
                                <a class="fas fa-check-square fa-3x validate-check"
                                   href="{{route('validate_route',['name_room'=>$room->name_room,'id'=>$routeBloc->id_route])}}"></a>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
