@extends('layouts.app')
@section('content')

    @if($finishedRoutes->isEmpty())
        <h1 class="text-center">Mon Profil</h1>
        <section id="infoCompte">
            <div class="infoCompte-center">
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
            </div>

            <a class="btn modify button-shadow" href="{{route('update_profile')}}">Modifier mes informations</a>
        </section>

    @else

        <h1 id="profil">Mon Profil</h1>
        <h1 id="succes">Mes Performances</h1>
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
                <div class="achievements">
                    <h1 class="roomsuccess">
                        <p>Salle : {{$finishedRoute->name_room}}</p>
                    </h1>
                    <table class="inforoute nope">
                        <thead>
                        <tr>
                            <td>Difficulté</td>
                            <td>Couleur</td>
                            <td>Secteur</td>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $finishedRoute->difficulty_route }}</td>
                            <td>{{ $finishedRoute->color->name_color }}</td>
                            <td>{{ $finishedRoute->name }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach
        </section>
    @endif

@endsection
@section('scripts')
    <script src="{{asset('js/profile.js')}}"></script>
@endsection
