@extends('layouts.app')
@section('content')

    <table class="table table-container">
        <thead>
        <tr>
            <th scope="col">Nom</th>
            <th scope="col">Score</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            @if($user->isAdmin == false)
                <tr>
                    <td><a href="">{{$user->name}}</a></td>
                    <td>{{$user->score}}</td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@endsection
