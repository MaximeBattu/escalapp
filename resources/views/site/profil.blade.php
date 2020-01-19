@extends('layouts.app')
@section('content')

    <h1 id="title">Mon Profil</h1>

    <div id="photo">
        <img src="{{URL::asset('/img/default_acount_logo.png')}}">
        <i class="fas fa-pen"></i>
    </div>

    <section class="infoCompte">
        <h1>Nom : {{$user->name}}</h1>
        <h1>Prénom : {{$user->firstname}}</h1>
        <h1>Email : {{$user->email}}</h1>
        <h1>Score : {{$user->score}}</h1>
        <h1>Voies faites : 0</h1>
        <h1>Voies réussites : 0</h1>
        <a class="btn modify button-shadow" href="{{route('update_profile')}}">Modifier mes informations</a>
    </section>
    <section style="position: absolute;left: 70%;top: 30%;background-color: red">
        @foreach($finishedRoutes as $finishedRoute)
            <h1>
                <p>{{$finishedRoute->name_room}}</p>
            </h1>
            <p>{{ $finishedRoute->url_photo }}</p>
            <p>{{ $finishedRoute->difficulty_route }}</p>
            <p>{{ $finishedRoute->color_route }}</p>
            <p>{{ $finishedRoute->name }}</p>

        @endforeach
        </section>

@endsection
