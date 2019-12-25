@include('header')

@if(\Session::has('error'))
    <div class="alert alert-danger">
        {{\Session::get('error')}}
    </div>
@endif

@if(isset(Auth::user()->id) && Auth::user()->isAdmin == true) <!-- on vérifie que l'utilisateur est connecté et qu'il est bien administrateur-->

<h1>
    <a href="{{route('see_home_admin')}}">Page de gestion</a>
</h1>

<h1 class="text-center">Salles disponibles : {{count($salles)}}</h1>
<table class="table salles-admin">
    <thead>
    <tr class="d-flex">
        <th class="col-md-1">ID</th>
        <th class="col-md-3">Nom</th>
        <th class="col-md-2">Numéro téléphone</th>
        <th class="col-md-3">Adresse</th>
        <th class="col-md-1"></th>
        <th colspan="2" class="col-md-2 room-change">Changement</th>
    </tr>
    </thead>
    <tbody>
    @foreach($salles as $salle)
        <tr class="d-flex">
            <td class="col-md-1" scope="row">{{$salle->id_room}}</td>
            <td class="col-md-3">{{$salle->name_room}}</td>
            <td class="col-md-2">{{$salle->tel_room}}</td>
            <td class="col-md-3">{{$salle->address_room}}</td>
            <td class="col-md-1">
                <a href="{{route('see_room', ['id'=>$salle->id_room])}}">Voir salle</a>
            </td>
            <td class="col-md-1 room-change">
                <button type="button" class="btn btn-warning">Modifier</button>
            </td>
            <td class="col-md-1 room-change">
                <a type="button" class="btn btn-danger" href="{{route('delete_room',['id'=>$salle->id_room])}}">Supprimer</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@else

    <h1 class="text-center">Salles disponibles : {{count($salles)}}</h1>
    <div class="container-fluid">
        <div class="row align-items-center justify-content-center">
            @foreach($salles as $salle)
                <div class="col-md-3 boxRoom">
                    <p>
                        <strong>Nom :</strong> {{$salle->name_room}}
                    </p>
                    <p>
                        <strong>Numéro :</strong> {{$salle->tel_room}}
                    </p>
                    <p>
                        <strong>Adresse :</strong> {{$salle->address_room}}
                    </p>
                    <p>
                        <a href="{{route('see_room', ['id'=>$salle->id_room])}}">Voir salle</a>
                    </p>
                </div>
            @endforeach
        </div>
    </div>

@endif


@include('footer')
