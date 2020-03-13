@extends('layouts.app')
@section('content')

    @if(isset($routes) && $routes->isEmpty())

        <div class="container">
            <h1 class="text-center">Aucune salle renseignée sur le secteur <strong>{{$sector->name}}</strong></h1>
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

        <h1 class="text-center">
            <a href="{{route('see_room_management')}}" title="Revenir à la page de gestion des salles" class="navigation-link">Salle : {{$room->name_room}} </a>
            /
            <a href="{{route('see_sectors_admin', ['name_room_slug'=>Str::slug($room->name_room), 'id'=>$room->id_room])}}" class="navigation-link" title="Revenir à la page des sectors de la salle : {{$room->name_room}}">Secteur : {{$sector->name}}</a>
        </h1>
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
        <table class="table voies-admin">
            <thead>
            <tr>
                <th class="table-text">ID</th>
                <th class="table-text">Couleur</th>
                <th class="table-text">Code Couleur</th>
                <th class="table-text">Difficulté</th>
                <th class="table-text">Crée le</th>
                <th class="table-text">Labels</th>
                <th class="table-text"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($routes as $route)
                <tr>
                    <td class="align-middle table-text route-id"> {{$route->id_route}}</td>
                    <td class="d-none color-id">{{$route->color->id_color}}</td>
                    <td class="align-middle table-text route-color-name updatable-field-route">{{$route->color->name_color}}</td>
                    <td class="d-none align-middle route-color-td">
                        <input type="text" class="route-color-input input-text-size field-update-route">
                    </td>
                    <td class="align-middle table-text route-code updatable-field-route">{{$route->color->code_color}}</td>
                    <td class="d-none align-middle route-color-td">
                        <input type="text" class="route-color-input input-text-size field-update-route">
                    </td>
                    <td class="align-middle table-text route-difficulty updatable-field-route">{{$route->difficulty_route}}</td>
                    <td class="d-none align-middle route-difficulty-td">
                        <input type="text" class="route-difficulty-input input-text-size field-update-route">
                    </td>
                    <td class="d-none align-middle route-score-td">
                        <input type="text" class="route-score-input input-text-size field-update-route">
                    </td>
                    @if(isset($route->created_at))
                        <td class="align-middle table-text">{{$route->created_at->format('d/m/yy')}}</td>
                    @else
                        <td class="align-middle table-text">Aucune mise à jour</td>
                    @endif

                    <td class="align-middle table-text">
                        @if($route->labels !== null)
                            <input type="text" class="text-center route-labels" placeholder="{{$route->labels}}">
                        @else
                            <input type="text" class="text-center route-labels" placeholder="Physique - Agilité ... ">
                        @endif
                    </td>

                    <td class="align-middle table-text text-center">
                        <form method="post" action="{{route('delete_route',['id_route'=>$route->id_route])}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="fas fa-trash-alt fa-2x delete" onclick="return confirm('Voulez-vous supprimer cette voie ?')"></button>
                        </form>
                    </td>
                </tr>
                @if(isset($route->color_secondary) && $route->color_secondary !== null)
                <tr id="second-row">
                    <td class="secondary-color"></td>
                    <td class="d-none align-middle table-text route-id"> {{$route->id_route}}</td>
                    <td class="d-none color-id">{{$route->color_secondary->id_color}}</td>
                    <td class="align-middle table-text route-color-name updatable-field-route secondary-color">{{$route->color_secondary->name_color}}</td>
                    <td class="d-none align-middle route-color-td">
                        <input type="text" class="route-color-input input-text-size field-update-route">
                    </td>
                    <td class="align-middle table-text route-code updatable-field-route secondary-color">{{$route->color_secondary->code_color}}</td>
                    <td class="d-none align-middle route-color-td">
                        <input type="text" class="route-color-input input-text-size field-update-route">
                    </td>

                    <td class="d-none align-middle table-text route-difficulty updatable-field-route">{{$route->difficulty_route}}</td>
                    <td class="d-none align-middle route-difficulty-td">
                        <input type="text" class="route-difficulty-input input-text-size field-update-route">
                    </td>
                @else
                    <td class="secondary-color"></td>
                    <td class="align-middle table-text route-color-name updatable-field-route secondary-color"></td>
                    <td class="d-none align-middle route-color-td">
                    <td class="align-middle table-text route-code updatable-field-route secondary-color"></td>
                    <td class="d-none align-middle table-text route-difficulty updatable-field-route"></td>
                @endif
                    <td class="secondary-color"></td>
                    <td class="secondary-color"></td>
                    <td class="secondary-color"></td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endif

@endsection

@section('scripts')
    <script src="{{asset('js/admin/route-admin.js')}}"></script>
@endsection

