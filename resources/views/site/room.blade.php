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
                <a href="{{route('see_routes', ['name_room_slug'=>Str::slug($room->name_room),'id'=>$room->id_room])}}" class="text-center content-voie">
                    <div class="content-image">
                        <div class="content-image-room">
                            <img src="{{URL::asset('/img/image_route.png')}}" alt="" class="image-room">
                        </div>
                        <span class="text-image-room">Voies</span>
                    </div>
                </a>
                <a href="{{route('see_blocs', ['name_room_slug'=>Str::slug($room->name_room),'id'=>$room->id_room])}}" class="text-center content-bloc">
                    <div class="content-image">
                        <div class="content-image-room">
                            <img src="{{URL::asset('/img/image_boulder.png')}}" alt="" class="image-room room-bloc">
                        </div>
                        <span class="text-image-room">Blocs</span>
                    </div>
                </a>
            @elseif($hasRoutes && $hasBlocs == false)
                <a href="{{route('see_routes', ['name_room_slug'=>Str::slug($room->name_room),'id'=>$room->id_room])}}" class="text-center">
                    <div class="content-image">
                        <div class="content-image-voie-room">
                            <img src="{{URL::asset('/img/mur.jpg')}}" alt="" class="image-room__only-voie">
                        </div>
                        <span class="text-image-room__voie-only">Voies</span>
                    </div>
                </a>

            @elseif($hasRoutes == false && $hasBlocs)
                <a href="{{route('see_blocs', ['name_room_slug'=>Str::slug($room->name_room),'id'=>$room->id_room])}}" class="text-center content-only-bloc">
                    <div class="content-image">
                        <div class="content-image-voie-room">
                            <img src="{{URL::asset('/img/mur.jpg')}}" alt="" class="image-room__only-bloc">
                        </div>
                        <span class="text-image-room__bloc-only">Voies</span>
                    </div>
                </a>
            @else
                <div>
                    <h1 class="text-center">Aucun bloc / voie n'a été renseigné</h1>
                </div>
            @endif


        </div>
    </section>

@endsection
