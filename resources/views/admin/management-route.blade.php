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
                <th class="table-text">Code Couleur</th>
                <th class="table-text">Difficulté</th>
                <th class="table-text">Dernière mise à jour</th>
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

                    <td class="align-middle table-text text-center">
                        <form method="post" action="{{route('delete_route',['id_route'=>$route->id_route])}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="fas fa-trash-alt fa-2x delete"></button>
                        </form>
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

