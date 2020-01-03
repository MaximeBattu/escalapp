@extends('layouts.app')
@section('content')

    <h1>
        <a href="{{route('see_room_management')}}">Gestion des salles</a>
    </h1>

    <h1 class="text-center">{{count($users)}} utilisateurs enregistrés</h1>

    <table class="table salles-admin">
        <thead>
        <tr class="d-flex">
            <th class="col-md-1">ID</th>
            <th class="col-md-2">Nom</th>
            <th class="col-md-3">email</th>
            <th class="col-md-2">Crée le</th>
            <th class="col-md-1">Administateur</th>
            <th colspan="2" class="col-md-3 room-change">Changement</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr class="d-flex">
                <td class="col-md-1" scope="row">{{$user->id}}</td>
                <td class="col-md-2">{{$user->name}}</td>
                <td class="col-md-3">{{$user->email}}</td>
                <td class="col-md-2">{{$user->created_at->format('d/m/Y')}}</td>
                @if($user->isAdmin == false)
                    <td class="col-md-1">Non</td>
                    <td class="col-md-2 room-change">
                        <a type="button" class="btn btn-primary" href="{{route('modify_user',['id'=>$user->id])}}">Mettre
                            Administrateur</a>
                    </td>
                    <td class="col-md-1 room-change">
                        <a type="button" class="btn btn-danger" href="{{route('delete_user',['id'=>$user->id])}}">Supprimer</a>
                    </td>
                @elseif(isset(Auth::user()->id) && Auth::user()->id == $user->id && Auth::user()->isAdmin == true)
                    <td class="col-md-1">Oui</td>
                    <td class="col-md-2 room-change"></td>
                    <td class="col-md-1 room-change"></td>
                @else
                    <td class="col-md-1">Oui</td>
                    <td class="col-md-2 room-change">
                        <a type="button" class="btn btn-warning" href="{{route('remove_administrator_right',['id'=>$user->id])}}">Enlever droits adminsitrateur</a>
                    </td>
                    <td class="col-md-1 room-change">
                        <a type="button" class="btn btn-danger" href="{{route('delete_user',['id'=>$user->id])}}">Supprimer</a>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(\Session::has('add-administrator-right'))
        <div class="alert alert-success" id="administratorRight">
            {{\Session::get('add-administrator-right')}}
        </div>
    @endif
    @if(\Session::has('remove-administrator-right'))
        <div class="alert alert-success" id="administratorRight">
            {{\Session::get('remove-administrator-right')}}
        </div>
    @endif
@endsection
