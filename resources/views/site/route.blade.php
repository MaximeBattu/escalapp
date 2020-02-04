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

    <section class="filter">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card formContainer">
                        <div
                            class="card-header formTitle font-size-head-form">{{ __('Filtre') }}</div>
                        <div class="card-body d-inline">
                            <form method="post" action="{{route('filter_route',['name_room_slug'=>Str::slug($room->name_room),'id_room'=>$room->id_room])}}">
                                {{csrf_field()}}

                                <div class="form-group row new-infos">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-right font-size-text">{{ __('Nom secteur') }}</label>

                                    <div class="col-md-6">
                                        <select id="name" type="text" class="form-control selectpicker font-size-text" name="sectorNameFilter"
                                            placeholder="nom salle">
                                            <option value="">Nom secteur</option>
                                            @foreach($sectors as $sector)
                                                <option value="{{$sector->name}}" @if( old($sector->name)  == $sector->name) selected="selected" @endif>{{$sector->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row new-infos">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-right font-size-text">{{ __('Couleur') }}</label>

                                    <div class="col-md-6">
                                        <select id="name" type="text" class="form-control font-size-text" name="colorFilter"
                                            placeholder="nom salle">
                                            <option value="">Couleur route</option>
                                            @foreach($colors as $color)
                                             <option value="{{$color}}">{{$color}}</option>
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row new-infos">
                                    <label for="name"
                                        class="col-md-4 col-form-label text-md-right font-size-text">{{ __('Difficulté') }}</label>

                                    <div class="col-md-6">
                                        <select id="name" type="text" class="form-control font-size-text" name="difficultyFilter"
                                            placeholder="nom salle">
                                            <option value="">Difficulté</option>
                                            @foreach($difficulties as $difficulty)
                                             <option value="{{$difficulty}}">{{$difficulty}}</option>
                                            @endforeach 
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="d-inline-block btn button-shadow font-size-text" name="submit"
                                        value="Filtre">Filter
                                </button>
                               
                            </form>
                            <form method="post">

                                    <button type="submit" class="d-inline-block btn button-shadow font-size-text" name="submit"
                                    value="Filtre">Réinitialiser
                            </button>
    
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </section>

@endsection
