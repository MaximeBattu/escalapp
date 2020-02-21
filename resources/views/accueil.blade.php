@extends('layouts.app')
@section('content')

    <div class="background"></div>
    <div>
        <div class="row align-items-center justify-content-center d-flex responsive">
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

@endsection
