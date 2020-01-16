@extends('layouts.app')
@section('content')

    <section>
        <div class="infos-room">
            <section class="text-center">
                <article class="">
                    <h2 class="Nom_Salle">
                        <strong>{{$salle->name_room}}</strong>
                    </h2>
                </article>
                <article class="">
                    {{$salle->address_room}}
                </article>
                <article class="">
                    {{$salle->email}}
                </article>
            </section>
        </div>
        <div>
            <a href="{{route('see_route', ['id'=>$salle->id_room])}}" class="text-center content-voie">
                <div class="content-image">
                    <span class="text-image-room">Voies</span>
                    <img src="{{asset('img/header1.jpg')}}" class="clickable-image">
                </div>

            </a>
            <a href="{{route('see_bloc', ['id'=>$salle->id_room])}}" class="text-center content-bloc">
                <div class="content-image">
                    <span class="text-image-room">Blocs</span>
                    <img src="{{asset('img/bloc.jpg')}}" class="clickable-image">
                </div>

            </a>


        </div>
    </section>

@endsection
