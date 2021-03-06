@extends('layouts.app')
@section('content')

    <div class="row justify-content-around">
        <div id="contest">
            <h2>Contest en cours</h2>
            <div id="ranking">
                @if($users != null && $users->isNotEmpty())
                    @foreach($users as $user)

                        <div>
                            @if($nb_users <= 3)
                                <p><strong>{{$nb_users++}} - {{$user->name." ".$user->score}}</strong></p>
                            @else
                                <p>{{$nb_users++}} - {{$user->name." ".$user->score}}</p>
                            @endif
                        </div>
                    @endforeach
                @else
                    <h5>Aucune voie n'a été validée pour l'instant</h5>
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
                            @if($route->color !== null)
                                @if($route->color_secondary !== null)
                                    <span class="image__secondary-color" id="image"
                                          style="border:5px solid {{$route->color_secondary->code_color}};">

                                    </span>
                                    <img src="{{URL::asset('/img/'.$route->url_photo)}}" alt="" class="img image-route"
                                         id="image"
                                         style="border:10px solid {{$route->color->code_color}};">

                                @else
                                    <img src="{{URL::asset('/img/'.$route->url_photo)}}" alt="" class="img image-route"
                                         id="image"
                                         style="border:5px solid {{$route->color->code_color}}">
                                @endif
                            @else
                                <img src="{{URL::asset('/img/'.$route->url_photo)}}" alt="" class="img image-route"
                                     id="image">
                            @endif
                        </td>
                        <td class="align-middle table-text">{{$route->difficulty_route}}</td>
                        <td class="align-middle table-text">{{$route->score_route}} pts</td>
                        <td class="align-middle table-text">
                            @if($route->finished)
                                <form method="post"
                                      action="{{route('delete_validated_route',['id'=>$route->id_route])}}">
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
                            @if($route->liked)
                                <i class="fas fa-thumbs-up fa-1x d-inline-block like unlike-route"></i>
                                <span class="d-inline-block number-like">{{$route->number_likes}}</span>
                            @else
                                <i class="far fa-thumbs-up fa-1x d-inline-block like like-route"></i>
                                <span class="d-inline-block number-like">{{$route->number_likes}}</span>
                            @endif

                        </td>
                    </tr>

                    <tr>
                        @if($route->first_person['firstname'] !== null)
                            <td class="second-row__route first-person__route"
                                title="Premier grimpeur a avoir validé la voie !">
                            <span class="table-text">
                                <strong>{{$route->first_person['firstname']}}</strong>
                            </span>
                            </td>
                        @else
                            <td class="second-row__route">
                            </td>
                        @endif
                        <td class="second-row__route">
                            @if($route->labels !== null)
                                <span class="table-text" style="background-color:red;">
                                    {{$route->labels}}
                                </span>
                            @endif
                        </td>
                        <td class="second-row__route admin-help">
                            <span class="table-text">
                                Aide pour la voie
                            </span>
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <section class="filter" id="filter">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card formContainer">
                        <div
                            class="card-header formTitle font-size-head-form">{{ __('Filtre') }}</div>
                        <div class="card-body d-inline filter-content">
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
                            <form id="reset-form" action="#" class="reset__form-button">
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
