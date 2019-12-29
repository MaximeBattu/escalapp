@extends('layouts.app')
@section('content')

<h1 class="text-center">
    <a href="{{route('see_room_management')}}">Gestion des salles</a>
</h1>

<h1 class="text-center">{{count($users)}} utilisateurs enregistrés</h1>

<table class="table salles-admin">
    <thead>
    <tr class="d-flex">
        <th class="col-md-1">ID</th>
        <th class="col-md-3">Nom</th>
        <th class="col-md-3">email</th>
        <th class="col-md-2">Crée le</th>
        <th class="col-md-1">Administateur</th>
        <th class="col-md-1 room-change">Changement</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        <tr class="d-flex">
            <td class="col-md-1" scope="row">{{$user->id}}</td>
            <td class="col-md-3">{{$user->name}}</td>
            <td class="col-md-3">{{$user->email}}</td>
            <td class="col-md-2">{{$user->created_at->format('d/m/Y')}}</td>
            @if($user->isAdmin == true)
                <td class="col-md-1">Oui</td>
            @else
                <td class="col-md-1">Non</td>
            @endif
            <td class="col-md-1 room-change">
                <a type="button" class="btn btn-danger" href="">Supprimer</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection
