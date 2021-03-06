@extends('layouts.app')
@section('content')


    @if(isset($sectors) && $sectors->isEmpty())

        <div class="container">
            <h1 class="text-center">Aucun secteur renseigné sur cette salle</h1>
        </div>

        <div>
            <a type="button" class="btn button-shadow button-text-size add-sector-no-data"
               href="{{route('see_add_sector',['name_room_slug'=>Str::slug($room->name_room),'id'=>$room->id_room])}}">Ajouter
                un secteur</a>
        </div>

    @else

        <h1 class="text-center">
            <a href="{{route('see_room_management')}}" class="navigation-link" title="Revenir à la page de gestion des salles">Salle : {{$room->name_room}} </a>
                / Les secteurs</h1>
        <div>
            <a type="button" class="btn button-shadow add-sector"
               href="{{route('see_add_sector',['name_room_slug'=>Str::slug($room->name_room),'id'=>$room->id_room])}}">Ajouter
                un secteur</a>
        </div>
        <table class="table salles-admin">
            <thead>
            <tr>
                <th class="table-text">ID</th>
                <th class="table-text">Nom</th>
                <th class="table-text">Type de voie</th>
                <th class="table-text">Mise à jour</th>
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
                    <td class="align-middle table-text text-right">
                        <div class="d-inline-block">
                            <a type="button" class="btn button-shadow" href="{{route('see_routes_admin',[
                    'name_room_slug'=>Str::slug($room->name_room),
                    'id_room'=>$room->id_room,
                    'name_sector_slug'=>Str::slug($sector->name),
                    'id_sector'=>$sector->id_sector
                    ])}}">
                                Voir secteur
                            </a>
                        </div>
                        <div class="d-inline-block">
                            <form method="post" action="{{route('delete_sector',['id_sector'=>$sector->id_sector])}}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="fas fa-trash-alt fa-2x delete" onclick="return confirm('Voulez-vous supprimer le secteur {{$sector->name}} ?')"></button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        @if (\Session::has('sector-deletion'))
            <div class="alert alert-success popup font-size-text" id="sector-deletion">
                {{\Session::get('sector-deletion')}}
            </div>
        @elseif(\Session::has('add_sector_failure'))
            <div class="alert alert-warning popup font-size-text" id="add-sector-failure">
                {{\Session::get('add_sector_failure')}}
            </div>
        @endif

    @endif

@endsection

@section('scripts')
    <script src="{{asset('js/admin/sector-admin.js')}}"></script>
@endsection
