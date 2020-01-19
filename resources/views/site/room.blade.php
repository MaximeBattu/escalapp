@extends('layouts.app')
@section('content')

    <section>
        <div class="infos-room">
            <section class="text-center">
                <article class="">
                    <h2 class="Nom_Salle">
                        <strong>{{$room->name_room}}</strong>
                    </h2>
                </article>
                <article class="">
                    {{$room->address_room}}
                </article>
                <article class="">
                    {{$room->email}}
                </article>
            </section>
        </div>
        <div>
            @if($hasRoutes && $hasBlocs)
                <a href="{{route('see_routes', ['name_room'=>$room->name_room])}}" class="text-center content-voie">
                    <div class="content-image">
                        <span class="text-image-room">Voies</span>
                    </div>
                </a>
                <a href="{{route('see_blocs', ['name_room'=>$room->name_room])}}" class="text-center content-bloc">
                    <div class="content-image">
                        <span class="text-image-room">Blocs</span>
                    </div>
                </a>
            @elseif($hasRoutes && $hasBlocs == false)
                <a href="{{route('see_routes', ['name_room'=>$room->name_room])}}" class="text-center content-voie">
                    <div class="content-image">
                        <span class="text-image-room">Voies</span>
                    </div>
                </a>
                <div class="text-center content-empty-bloc">
                    <div class="content-image">
                        <span class="text-image-room">Aucun blocs n'a été enregistrés</span>
                    </div>
                </div>
            @elseif($hasRoutes == false && $hasBlocs)
                <div class="text-center content-empty-voie">
                    <div class="content-image">
                        <span class="text-image-room">Aucune voies n'a été enregistrées</span>
                    </div>
                </div>
                <a href="{{route('see_blocs', ['name_room'=>$room->name_room])}}" class="text-center content-bloc">
                    <div class="content-image">
                        <span class="text-image-room">Blocs</span>
                    </div>
                </a>
            @else
                <div class="text-center content-empty-voie">
                    <div class="content-image">
                        <span class="text-image-room">Aucune voies n'a été enregistrées</span>
                    </div>
                </div>
                <div class="text-center content-empty-bloc">
                    <div class="content-image">
                        <span class="text-image-room">Aucun blocs n'a été enregistrés</span>
                    </div>
                </div>
            @endif


        </div>
    </section>

@endsection
