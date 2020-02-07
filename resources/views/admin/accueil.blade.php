@extends('layouts.app')
@section('content')

    <div class="content-button d-flex flex-column bd-highlight mb-3">
        <div class="p-2 bd-highlight">
            <a href="{{route('see_room_management')}}">
                <button type="button" class="btn button-shadow button button-text-size">Gestion des salles</button>
            </a>
        </div>
        <div class="p-2 bd-highlight">
                <a href="{{route('see_home')}}">
                    <button type="button" class="btn button-shadow button button-text-size">Voir les salles</button>
                </a>
            </div>
        <div class="p-2 bd-highlight">
            <a href="{{route('see_user_management')}}">
                <button type="button" class="btn button-shadow button button-text-size">Gestion des comptes</button>
            </a>
        </div>
    </div>

@endsection
