@extends('layouts.app')
@section('content')
    <section>
        <div class="infos-room">
            <section class="text-center">
                <article>
                    <h2 class="Nom_Salle">
                        <strong>{{$room->name_room}}</strong>
                    </h2>
                </article>
                <article>
                    {{$room->address_room}}
                </article>
                <article>
                    {{$room->email}}
                </article>
            </section>
        </div>

    </section>
    <div>

    @if($hasRoutes && $hasBlocs)
        <section class="section__split">
            <a href="{{route('see_routes', ['name_room_slug'=>Str::slug($room->name_room),'id'=>$room->id_room])}}">
                <div class="section-split__image image-left"></div>
            </a>
            <div class="section-split__text text-left">Voies</div>
            <a href="{{route('see_blocs', ['name_room_slug'=>Str::slug($room->name_room),'id'=>$room->id_room])}}">
                <div class="section-split__image image-right"></div>
            </a>
            <div class="section-split__text text-right">Blocs</div>
        </section>
    @elseif($hasRoutes && $hasBlocs === false)
        <section class="section__one">
            <a href="{{route('see_routes', ['name_room_slug'=>Str::slug($room->name_room),'id'=>$room->id_room])}}">
                <div class="section-one_image image-voie"></div>
            </a>
            <div class="section-one__text">Voies</div>
        </section>

    @elseif($hasRoutes === false && $hasBlocs)
            <section class="section__one">
                <a href="{{route('see_blocs', ['name_room_slug'=>Str::slug($room->name_room),'id'=>$room->id_room])}}">
                    <div class="section-one_image image-bloc"></div>
                </a>
                <div class="section-one__text">Blocs</div>
            </section>
    @else
        <div>
            <h1 class="text-center">Aucun bloc / voie n'a été renseigné</h1>
        </div>
    @endif

    </div>
@endsection

