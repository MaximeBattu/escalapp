@extends('layouts.app')
@section('content')

    <section class="text-center">
        <article class="">
            <h1 class="Nom_Salle">Type de voie : mur</h1>
            <h1>Numéro voie : {{$route->id_route}}</h1>
            <h1>Couleur : {{$route->color_route}}</h1>
            <h1>Difficulté : {{$route->difficulty_route}}</h1>
            <h1>Image : {{$route->url_photo}}</h1>
        </article>
        <div>
            @if(isset($finishedRoute) && $finishedRoute->isNotEmpty())
                @foreach($finishedRoute as $fr)
                    @if($fr->id_user == Auth::user()->id)
                        <p class="alert alert-success">
                            Déjà validée
                        </p>
                    @endif
                @endforeach
            @else
                <a class="btn btn-primary" href="{{route('add_validated_route',['idroom'=>$route->id_room,'id'=>$route->id_route])}}">Valider la voie</a>
                <a class="btn btn-warning" href="">J'ai essayé la voie</a>
            @endif
        </div>
    </section>

@endsection
