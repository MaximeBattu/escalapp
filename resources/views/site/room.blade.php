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
            <a href="{{route('see_routes', ['name_room'=>$room->name_room])}}" class="text-center content-voie">
                <div class="content-image">
                    <span class="text-image-room">Voies : {{ $hasRoutes }}</span>
                    <img src="{{asset('img/header1.jpg')}}" class="clickable-image">
                </div>

            </a>
            <a href="{{route('see_blocs', ['name_room'=>$room->name_room])}}" class="text-center content-bloc">
                <div class="content-image">
                    <span class="text-image-room">Blocs : {{ $hasBlocs }}</span>
                    <img src="{{asset('img/bloc.jpg')}}" class="clickable-image">
                </div>

            </a>


        </div>
    </section>

@endsection
