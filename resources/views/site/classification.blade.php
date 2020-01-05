@extends('layouts.app')
@section('content')

    <table class="table ranking">
        <thead>
        <tr>
            <th scope="col" class="columns">Rang</th>
            <th scope="col" class="columns">Nom</th>
            <th scope="col" class="columns">Score</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            @if($user->isAdmin == false)
                <tr class="text-center">
                    <td></td>
                    <td id="middle-column"><a href="">{{$user->name}}</a></td>
                    <td>{{$user->score}}</td>
                </tr>
            @endif
        @endforeach
        </tbody>
    </table>
@endsection
