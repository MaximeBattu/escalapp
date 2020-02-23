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
                        @if($route->color != null)
                            <img src="{{URL::asset('/img/'.$route->url_photo)}}" alt="" class="img image-route" id="image"
                                 style="border:5px solid {{$route->color->code_color}}">
                        @else
                            <img src="{{URL::asset('/img/'.$route->url_photo)}}" alt="" class="img image-route" id="image">
                        @endif
                    </td>
                    <td class="align-middle table-text">{{$route->difficulty_route}}</td>
                    <td class="align-middle table-text">{{$route->score_route}} pts</td>
                    <td class="align-middle table-text">
                        @if($route->finished)
                            <form method="post" action="{{route('delete_validated_route',['id'=>$route->id_route])}}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn fa fa-check fa-2x finished-check"></button>
                            </form>
                        @else
                            <form method="post" action="{{route('validate_route',['id_route'=>$route->id_route])}}">
                                {{ method_field('PUT') }}
                                {{ csrf_field() }}
                                <button type="submit" class="btn fas fa-check-square fa-3x validate-check"></button>
                            </form>
                        @endif
                    </td>
                    <td class="table-text align-bottom">
                        <span class="d-none like-route-id">{{$route->id_route}}</span>
                        <span class="table-text d-block">
                                {{$route->first_person['firstname']}}
                            </span>
                        @if($route->liked)
                            <i class="fas fa-thumbs-up fa-1x d-inline-block like unlike-route"></i>
                            <span class="d-inline-block number-like">{{$route->number_likes}}</span>
                        @else
                            <i class="far fa-thumbs-up fa-1x d-inline-block like like-route"></i>
                            <span class="d-inline-block number-like">{{$route->number_likes}}</span>
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
                        <form id="filter-form" action="#">
                            <div class="form-group row new-infos">
                                <label for="sector"
                                       class="col-md-4 col-form-label text-md-right font-size-text">{{ __('Nom secteur') }}</label>

                                <div class="col-md-6">
                                    <select id="sector" type="text" class="form-control selectpicker font-size-text"
                                            name="sectorName">
                                        <option value="">Nom secteur</option>
                                        @foreach($sectors as $sector)
                                            <option
                                                @if($sector->name === $selectedName) {{ 'selected' }} @endif value="{{$sector->name}}">{{$sector->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row new-infos">
                                <label for="color"
                                       class="col-md-4 col-form-label text-md-right font-size-text">{{ __('Couleur') }}</label>

                                <div class="col-md-6">
                                    <select id="color" type="text" class="form-control font-size-text"
                                            name="color">
                                        <option value="">Couleur route</option>
                                        @foreach($colors as $color)
                                            <option
                                                @if($color === $selectedColor) {{ 'selected' }} @endif value="{{$color}}">{{$color}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row new-infos">
                                <label for="difficulty"
                                       class="col-md-4 col-form-label text-md-right font-size-text">{{ __('Difficulté') }}</label>

                                <div class="col-md-6">
                                    <select id="difficulty" type="text" class="form-control font-size-text"
                                            name="difficulty">
                                        <option value="">Difficulté</option>
                                        @foreach($difficulties as $difficulty)
                                            <option
                                                @if($difficulty === $selectedDifficulty) {{ 'selected' }} @endif value="{{$difficulty}}">{{$difficulty}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <button type="submit" class="d-inline-block btn button-shadow font-size-text"
                                    name="submit"
                                    value="Filtre">Filter
                            </button>

                        </form>
                        <form id="reset-form" action="#">
                            <button class="d-inline-block btn button-shadow font-size-text">
                                Réinitialiser
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
