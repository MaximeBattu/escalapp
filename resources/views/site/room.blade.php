@include('header')
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
    <div class="col-2 text-center">
       <h1><a href="{{route('see_route', ['id'=>$salle->id_room])}}">Voie</a></h1>
        <img src="{{asset('img/mur1.jpg')}}"style="max-height:100%;max-width:100% ;">
    </div>
    <div class="col-2 text-center">
        <h1><a href="">Bloc</a></h1>
        <img src="{{asset('img/header1.jpg')}}"style="max-height:100%;max-width:100% ;">
    </div>
</div>
@include('footer')
