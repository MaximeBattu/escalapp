@extends('layouts.app')
@section('content')

    <h1 class="text-center">
    Salle numéro : {{$salle->id_room}}
</h1>
<section class="text-center">
    <article class="">
        <h2 class="Nom_Salle">{{$salle->name_room}}</h2>
    </article>
    <article class="">
        {{$salle->address_room}}
    </article>
    <article class="">
        {{$salle->tel_room}}
    </article>
</section>



<div class="row justify-content-around">
    <div id="contest">
        <h2>Contest en cours</h2>
        <div id="close">x</div>
        <div id="ranking">
            
        </div>
        <div id="consult"><a href="">Consulter Contest</a></div>
    </div>
    <div id="open">></div>
    <div class="col-2 text-center">
       <h1><a href="{{route('see_route', ['id'=>$salle->id_room])}}">Voie</a></h1>
        <img src="{{asset('img/header1.jpg')}}"style="max-height:100%;max-width:100% ;">
    </div>
    <div class="col-2 text-center">
        <h1><a href="{{route('see_bloc', ['id'=>$salle->id_room])}}">Bloc</a></h1>
        <img src="{{asset('img/mur1.jpg')}}"style="max-height:100%;max-width:100% ;">
    </div>
</div>

@endsection
