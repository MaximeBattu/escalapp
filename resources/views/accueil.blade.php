@extends('layouts.app')
@section('content')

    @if(isset(Auth::user()->id) && Auth::user()->isAdmin == true) <!-- on vérifie que l'utilisateur est connecté et qu'il est bien administrateur-->

    <h1 class="text-center">{{count($salles)}} Salles disponibles</h1>
    <div>
        <a type="button" class="btn btn-success add-room" href="{{route('see_adding_room')}}">Ajouter une salle</a>
    </div>
    <table class="table salles-admin">
        <thead>
        <tr class="d-flex">
            <th class="col-md-1">ID</th>
            <th class="col-md-2">Nom</th>
            <th class="col-md-2">Adresse mail</th>
            <th class="col-md-2">Adresse</th>
            <th class="col-md-2">Dernière mise à jour</th>
            <th class="col-md-1"></th>
            <th colspan="2" class="col-md-2 room-change">Changement</th>
        </tr>
        </thead>
        <tbody>
        @foreach($salles as $salle)
            <tr class="d-flex">
                <td class="col-md-1">{{$salle->id_room}}</td>
                <td class="col-md-2">{{$salle->name_room}}</td>
                <td class="col-md-2">{{$salle->email}}</td>
                <td class="col-md-2">{{$salle->address_room}}</td>
                @if(isset($salle->updated_at))
                    <td class="col-md-2">{{$salle->updated_at->format('d/m/Y')}}</td>
                @else
                    <td class="col-md-2">Aucune mise à jour</td>
                @endif
                <td class="col-md-1">
                    <a type="button" class="btn btn-primary" href="{{route('see_sectors_admin', ['id'=>$salle->id_room])}}">Voir salle</a>
                </td>
                <td class="col-md-1 room-change">
                    <a type="button" class="btn btn-warning" href="{{route('modify_room',['id'=>$salle->id_room])}}">Modifier</a>
                </td>
                <td class="col-md-1 room-change">
                    <a type="button" class="btn btn-danger" href="{{route('delete_room',['id'=>$salle->id_room])}}">Supprimer</a>
                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    @if(\Session::has('add-success'))
        <div class="alert alert-success popup" id="addSuccessRoom">
            {{\Session::get('add-success')}}
        </div>
    @endif
    @else
        <div class="container-fluid">
            <div class="row align-items-center justify-content-center">
                @foreach($salles as $salle)
                    <a href="{{route('see_room', ['name_room'=>$salle->name_room])}}" class="col-md-3 boxRoom">
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
