@extends('layouts.app')
@section('content')

    <table class="table users-admin">
        <thead>
            <tr>
                <th class="table-text">ID</th>
                <th class="table-text">Prénom</th>
                <th class="table-text">Nom</th>
                <th class="table-text">email</th>
                <th class="table-text">Crée le</th>
                <th class="table-text">Administateur</th>
                <th class="room-change table-text">Changement</th>
            </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="align-middle table-text">{{$user->id}}</td>
                <td class="align-middle table-text">{{$user->firstname}}</td>
                <td class="align-middle table-text">{{$user->name}}</td>
                <td class="align-middle table-text">{{$user->email}}</td>
                <td class="align-middle table-text">{{$user->created_at->format('d/m/Y')}}</td>
                @if($user->isAdmin == false)
                    <td class="align-middle table-text">Non</td>
                    <td class="align-middle table-text d-flex justify-content-around">
                        <form method="post" action="{{route('modify_user',['id'=>$user->id])}}">
                            {{ csrf_field() }}
                            <button class="fas fa-user-edit fa-2x modify-user" type="submit"></button>
                        </form>
                        <form method="post" action="{{route('delete_user',['id'=>$user->id])}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="fas fa-trash-alt fa-2x delete"></button>
                        </form>
                    </td>
                @elseif(isset(Auth::user()->id) && Auth::user()->id == $user->id && Auth::user()->isAdmin == true)
                    <td class="align-middle table-text">Oui</td>
                    <td class="align-middle table-text d-flex justify-content-around user-is-admin">
                        <i class="fas fa-user-check fa-2x"></i>
                    </td>
                @else
                    <td class="align-middle table-text">Oui</td>
                    <td class="align-middle table-text d-flex justify-content-around">
                        <form method="post" action="{{route('remove_administrator_right',['id'=>$user->id])}}">
                            {{ csrf_field() }}
                            <button class="fas fa-user-check fa-2x modify-user user-is-admin other-user-is-admin"></button>
                        </form>
                        <form method="post" action="{{route('delete_user',['id'=>$user->id])}}">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="fas fa-trash-alt fa-2x delete"></button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    @if(\Session::has('add-administrator-right'))
        <div class="alert alert-success popup font-size-text" id="administratorRight">
            {{\Session::get('add-administrator-right')}}
        </div>
    @elseif(\Session::has('remove-administrator-right'))
        <div class="alert alert-success popup font-size-text" id="administratorRight">
            {{\Session::get('remove-administrator-right')}}
        </div>
    @endif
@endsection
