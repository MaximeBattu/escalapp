@extends('layouts.app')
@section('content')

    @if(isset(Auth::user()->id) && Auth::user()->isAdmin == true) <!-- on vérifie que l'utilisateur est connecté et qu'il est bien administrateur-->
        <div class="content-button d-flex flex-column bd-highlight mb-3">
            <div class="p-2 bd-highlight">
                <a href="{{route('see_room_management')}}">
                    <button type="button" class="btn button-shadow button input-text-size">Gestion des salles</button>
                </a>
            </div>
            <div class="p-2 bd-highlight">
                <a href="{{route('see_user_management')}}">
                    <button type="button" class="btn button-shadow button input-text-size">Gestion des comptes</button>
                </a>
            </div>
        </div>
    @else
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                @foreach($salles as $salle)
                    <a href="{{route('see_room', ['name_room_slug'=>Str::slug($salle->name_room),'id'=>$salle->id_room])}}"
                       class="col-md-3 boxRoom">
                        <div id="roomInfo">
                            <p id="roomname">
                                {{$salle->name_room}}
                            </p>
                            <p class="display-none">
                                {{$salle->email}}
                            </p>
                            <p class="display-none">
                                {{$salle->address_room}}
                            </p>
                        </div>

                    </a>
                @endforeach
            </div>
        </div>

        @if(\Session::has('error'))
            <div class="alert alert-danger popup" id="adminAccessError">
                {{\Session::get('error')}}
            </div>
        @endif
    @endif
@endsection
