@extends('layouts.app')
@section('content')

    <h1 class="text-center">Tous les secteurs de la salle : {{$room->name_room}}</h1>
    <div>
        <!-- A changer -->
        <a type="button" class="btn btn-success add-route" href="{{route('see_add_sector',['id_room'=>$room->id_room])}}">Ajouter un secteur</a>
    </div>
    <table class="table salles-admin">
        <thead>
        <tr class="d-flex">
            <th class="col-md-1">ID</th>
            <th class="col-md-3">Nom</th>
            <th class="col-md-2">Type de voie</th>
            <th class="col-md-2">Dernière mise à jour</th>
            <th class="col-md-2"></th>
            <th colspan="2" class="col-md-2 room-change">Changement</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sectors as $sector)
            <tr class="d-flex">
                <td class="col-md-1"> {{$sector->id_sector}}</td>
                <td class="col-md-3"> {{$sector->name}}</td>
                @if($sector->climbing_type == "V")
                    <td class="col-md-2">Voie</td>
                @else
                    <td class="col-md-2">Bloc</td>
                @endif
                @if(isset($sector->updated_at))
                    <td class="col-md-2">{{$sector->updated_at->format('d/m/yy')}}</td>
                @else
                    <td class="col-md-2">Aucune mise à jour</td>
                @endif
                <td class="col-md-2">
                    <a type="button" class="btn btn-primary" href="{{route('see_routes_admin', ['id'=>$sector->id_room,'idsector'=>$sector->id_sector])}}">Voir secteur</a>
                </td>
                <td class="col-md-2 room-change">
                    <a type="button" class="btn btn-danger" href="{{route('delete_sector',['id'=>$sector->id_sector])}}">Supprimer</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection
