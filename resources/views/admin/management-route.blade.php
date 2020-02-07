@extends('layouts.app')
@section('content')

    @if(isset($routes) && $routes->isEmpty())

        <div class="container">
            <h1 class="text-center">Aucune salle renseignée sur le secteur : <strong>{{$sector->name}}</strong></h1>
            <h1 class="text-center">Salle : <strong>{{$room->name_room}}</strong></h1>
        </div>

        <div>
            <a type="button" class="btn button-shadow button-text-size add-route-no-data"
               href="{{route('see_add_routes',[
                    'name_room_slug'=>Str::slug($room->name_room),
                    'id_room'=>$room->id_room,
                    'name_sector_slug'=>Str::slug($sector->name),
                    'id_sector'=>$sector->id_sector
                    ])}}">Ajouter
                une voie</a>
        </div>

    @else

        <h1 class="text-center">Salle : {{$room->name_room}} / Secteur : {{$sector->name}}</h1>
        <div>
            <a type="button" class="btn button-shadow add-route"
               href="{{route('see_add_routes',[
                    'name_room_slug'=>Str::slug($room->name_room),
                    'id_room'=>$room->id_room,
                    'name_sector_slug'=>Str::slug($sector->name),
                    'id_sector'=>$sector->id_sector
                    ])}}">Ajouter
                une voie</a>
        </div>
        <table class="table table-hover voies-admin">
            <thead>
            <tr>
                <th class="table-text">ID</th>
                <th class="table-text">Couleur</th>
                <th class="table-text">Difficulté</th>
                <th class="table-text">Type de voie</th>
                <th class="table-text">Score</th>
                <th class="table-text">Dernière mise à jour</th>
                <th class="table-text">Labels</th>
                <th class="table-text"></th>
                <th class="table-text"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($routes as $route)
                <tr>
                    <td class="align-middle table-text route-id"> {{$route->id_route}}</td>
                    @if($sector->climbing_type == "V")
                        <td class="align-middle table-text route-color updatable-field-route">{{$route->color_route}}</td>
                        <td class="d-none align-middle route-color-td">
                            <input type="text" class="route-color-input input-text-size field-update-route">
                        </td>
                        <td class="align-middle table-text route-difficulty updatable-field-route">{{$route->difficulty_route}}</td>
                        <td class="d-none align-middle route-difficulty-td">
                            <input type="text" class="route-difficulty-input input-text-size field-update-route">
                        </td>
                        <td class="align-middle table-text">Voie</td>
                    @else
                        <td class="align-middle table-text"></td>
                        <td class="align-middle table-text">{{$route->color_route}}</td>
                        <td class="align-middle table-text">Bloc</td>
                    @endif
                    <td class="align-middle table-text route-score updatable-field-route">{{$route->score_route}}</td>
                    <td class="d-none align-middle route-score-td">
                        <input type="text" class="route-score-input input-text-size field-update-route">
                    </td>
                    @if(isset($route->updated_at))
                        <td class="align-middle table-text">{{$route->updated_at->format('d/m/yy')}}</td>
                    @else
                        <td class="align-middle table-text">Aucune mise à jour</td>
                    @endif

                    <td class="align-middle table-text">
                        <select name="" id="">
                            <option value=""></option>
                            <option value="">Agilité</option>
                            <option value="">Physique</option>
                            <option value="">Rapide</option>
                        </select>
                    </td>
                    <td class="align-middle table-text">
                        <input type="text" placeholder="ajouter un label">
                    </td>

                    <td class="align-middle table-text text-center">
                        <a type="button" class="fas fa-trash-alt fa-2x delete"
                           href="{{route('delete_route',['name_room'=>$room->name_room,'name_sector'=>$sector->name,'idroute'=>$route->id_route])}}"></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif

@endsection

@section('scripts')
    <script src="{{asset('js/admin/route-admin.js')}}"></script>
@endsection

