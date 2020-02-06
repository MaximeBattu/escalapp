@extends('layouts.app')
@section('content')


    <div>
        <a type="button" class="btn button-shadow add-room" href="{{route('see_add_room')}}">Ajouter une salle</a>
    </div>
    <table class="table table-hover salles-admin">
        <thead>
        <tr>
            <th class="table-text">ID</th>
            <th class="table-text">Nom</th>
            <th class="table-text">Adresse mail</th>
            <th class="table-text">Adresse</th>
            <th class="table-text">Mise à jour</th>
            <th class="table-text"></th>
            <th class="table-text"></th>
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

                </td>
                <td class="align-middle table-text text-center">
                    <div class="d-inline-block">
                        <a type="button" class="btn button-shadow"
                           href="{{route('see_sectors_admin', ['id'=>$salle->id_room, 'name_room_slug' => Str::slug($salle->name_room) ])}}">Voir
                            salle</a>
                    </div>

                    <div class="d-inline-block">
                        <form method="post" action="{{route('delete_room',['id'=>$salle->id_room])}}">
                            {{csrf_field()}}
                            <a type="button" class="fas fa-trash-alt fa-2x delete"
                               href=""></a>
                        </form>

                    </div>

                </td>
            </tr>
        @endforeach
        </tbody>

    </table>
    @if(\Session::has('add-success'))
        <div class="alert alert-success popup font-size-text" id="addSuccessRoom">
            {{\Session::get('add-success')}}
        </div>
    @endif

@endsection

@section('scripts')
    <script src="{{asset('js/admin/room-admin.js')}}"></script>
@endsection
