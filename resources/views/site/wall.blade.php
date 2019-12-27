@extends('layouts.app')
@section('content')

    <div class="text-center">
        <h1>Salle Y</h1>

        <h2>Mur</h2>

        <div class="salle_mur_menu">
            <div class=""></div>
            <div class=""><a class="btn btn-link" href="#">Resultat Contest</a></div>
            <div class=""></div>
            <div class=""><a class="btn btn-link" href="{{route('see_salle')}}">Retour</a></div>
            <div class=""></div>
        </div>
    </div>

@endsection
