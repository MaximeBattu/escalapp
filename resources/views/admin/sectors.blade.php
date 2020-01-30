@extends('layouts.app')
@section('content')
    <h1 class="text-center">Tous les secteurs de la salle : {{$room->name_room}}</h1>
    <div>
        <!-- A changer -->
        <a type="button" class="btn btn-success add-route"
           href="{{route('see_add_sector',['name_room'=>$room->name_room])}}">Ajouter un secteur</a>
    </div>
    <table class="table salles-admin">
        <thead>
        <tr>
            <th class="table-text">ID</th>
            <th class="table-text">Nom</th>
            <th class="table-text">Type de voie</th>
            <th class="table-text">Dernière mise à jour</th>
            <th class="table-text"></th>
            <th colspan="2" class="table-text room-change"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($sectors as $sector)
            <tr>
                <td class="align-middle table-text sector-id"> {{$sector->id_sector}}</td>
                <td class="align-middle table-text sector-name updatable-field-sector"> {{$sector->name}}</td>
                <td class="d-none align-middle sector-name-td">
                    <input type="text" class="room-sector-input input-text-size field-update-sector">
                </td>
                @if($sector->climbing_type == "V")
                    <td class="align-middle table-text">Voie</td>
                @else
                    <td class="align-middle table-text">Bloc</td>
                @endif
                @if(isset($sector->updated_at))
                    <td class="align-middle table-text">{{$sector->updated_at->format('d/m/yy')}}</td>
                @else
                    <td class="align-middle table-text">Aucune mise à jour</td>
                @endif
                <td class="align-middle table-text">
                    <a type="button" class="btn button-shadow" href="{{route('see_routes_admin',[
                    'name_room_slug'=>Str::slug($room->name_room),
                    'id_room'=>$room->id_room,
                    'name_sector_slug'=>Str::slug($sector->name),
                    'id_sector'=>$sector->id_sector
                    ])}}">
                        Voir secteur
                    </a>
                </td>
                <td class="align-middle table-text text-center">
                    <a type="button" class="fas fa-trash-alt fa-2x delete"
                       href="{{route('delete_sector',['name_room'=>$room->name_room,'id'=>$sector->id_sector])}}"></a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    @if (\Session::has('sector-deletion'))
        <div class="alert alert-success">
            {{\Session::get('sector-deletion')}}
        </div>
    @endif

@endsection
