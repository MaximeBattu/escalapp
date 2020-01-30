@extends('layouts.app')
@section('content')

    @if(isset(Auth::user()->id) && Auth::user()->isAdmin == true) <!-- on vérifie que l'utilisateur est connecté et qu'il est bien administrateur-->

    <div>
        <a type="button" class="btn btn-success add-room" href="{{route('see_adding_room')}}">Ajouter une salle</a>
    </div>
    <table class="table salles-admin">
        <thead>
        <tr>
            <th class="table-text">ID</th>
            <th class="table-text">Nom</th>
            <th class="table-text">Adresse mail</th>
            <th class="table-text">Adresse</th>
            <th class="table-text">Dernière mise à jour</th>
            <th class="table-text"></th>
            <th colspan="2" class="table-text">Changement</th>
        </tr>
        </thead>
        <tbody>
        @foreach($salles as $salle)
            <tr id="room-admin"> <!-- devrait être une classe -->
                <td class="align-middle table-text room-id">{{$salle->id_room}}</td>
                <td class="align-middle table-text room-name updatable-field-room">{{$salle->name_room}}</td>
                <td class="d-none align-middle room-name-td">
                    <input type="text" class="room-name-input input-text-size field-update-room">
                </td>
                <td class="align-middle table-text room-email updatable-field-room">{{$salle->email}}</td>
                <td class="d-none align-middle room-email-td">
                    <input type="text" class="room-email-input input-text-size field-update-room">
                </td>
                <td class="align-middle table-text room-address updatable-field-room">{{$salle->address_room}}</td>
                <td class="d-none align-middle room-address-td">
                    <input type="text" class="room-address-input input-text-size field-update-room">
                </td>
                @if(isset($salle->updated_at))
                    <td class="align-middle table-text">{{$salle->updated_at->format('d/m/Y')}}</td>
                @else
                    <td class="align-middle table-text">Aucune mise à jour</td>
                @endif
                <td class="align-middle table-text">
                    <a type="button" class="btn button-shadow" href="{{route('see_sectors_admin', ['name_room'=>$salle->name_room])}}">Voir salle</a>
                </td>
                {{--<td class="align-middle table-text">
                    <a type="button" class="btn btn-warning" href="{{route('modify_room',['id'=>$salle->id_room])}}">Modifier</a>
                </td>--}}
                <td class="align-middle table-text text-center">
                    <a type="button" class="fas fa-trash-alt fa-2x delete" href="{{route('delete_room',['id'=>$salle->id_room])}}"></a>
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
