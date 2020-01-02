@extends('layouts.app')
@section('content')

    <section class="text-center">
        <h1>Nom : {{$user->name}}</h1> <br>
        <h1>Email : {{$user->email}}</h1> <br>
        <h1>Score : {{$user->score}}</h1> <br>
        <h1>Voies faites : 0</h1> <br>
        <h1>Voies réussites : 0</h1>
    </section>

    <a href="{{route('update_profile')}}">Modifier mes informations</a>

@endsection
