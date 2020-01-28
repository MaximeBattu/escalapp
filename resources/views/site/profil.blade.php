@extends('layouts.app')
@section('content')

    <h1 id="title">Mon Profil</h1>

    <section id="infoCompte">
        <div id="photo">
            <img src="{{URL::asset('/img/default_acount_logo.png')}}">
            <i class="fas fa-pen"></i>
        </div>
        <div id="otherInfo">
            <h1>Nom : {{$user->name}}</h1>
            <h1>Prénom : {{$user->firstname}}</h1>
            <h1>Email : {{$user->email}}</h1>
            <h1>Points : {{$user->score}}</h1>
        </div>

        <a class="btn modify button-shadow" href="{{route('update_profile')}}">Modifier mes informations</a>
    </section>
    <section id="achievement-container">
        @foreach($finishedRoutes as $finishedRoute)
            <div id="achievements">
                <h1 class="roomsuccess">
                    <p>{{$finishedRoute->name_room}}</p>
                </h1>
                <div class="score">
                    <p>{{ $finishedRoute->url_photo }}</p>
                    <p>{{ $finishedRoute->difficulty_route }}</p>
                    <p>{{ $finishedRoute->color_route }}</p>
                    <p>{{ $finishedRoute->name }}</p>
                </div>
            </div>
        @endforeach
    </section>

@endsection
