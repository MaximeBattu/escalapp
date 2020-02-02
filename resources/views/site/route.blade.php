@extends('layouts.app')
@section('content')

    <div class="row justify-content-around">
            <div id="contest">
                <h2>Contest en cours</h2>
                <div id="ranking">
                    @if($users != null && $users->isNotEmpty())
                        @foreach($users as $user)
                            <div>
                                <p>{{$user->name." ".$user->score}}</p>
                            </div>
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
            <table class="table table-route">
                <tbody>
                @foreach($routes as $route)
                    <tr class="text-center">
                        <td>
                            @if($route->color_route != null)
                                <img src="{{URL::asset('/img/'.$route->url_photo)}}" alt="" class="img" id="image"
                                     style="border:6px solid {{$route->color_route}}">
                            @else
                                <img src="{{URL::asset('/img/'.$route->url_photo)}}" alt="" class="img" id="image">
                            @endif
                        </td>
                        <td class="align-middle table-text">{{$route->difficulty_route}}</td>
                        <td class="align-middle table-text">{{$route->score_route}} pts</td>
                        <td class="align-middle table-text">
                            @if($route->finished)
                                <a class="fa fa-check fa-2x finished-check"
                                   href="{{route('delete_validated_route',['name_room'=>$room->name_room,'id'=>$route->id_route])}}"></a>
                            @else
                                <a class="fas fa-check-square fa-3x validate-check"
                                   href="{{route('validate_route',['name_room'=>$room->name_room,'id'=>$route->id_route])}}"></a>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection
