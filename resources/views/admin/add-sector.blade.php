@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card formContainer">
                <div class="card-header formTitle">{{ __('Ajouter un secteur') }}</div>
                <div class="card-body">
                    <form method="post" action="{{route('add_sector',['id'=>$room->id_room])}}">
                        {{csrf_field() }}

                        <div class="form-group row new-infos">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom Secteur') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" placeholder="nom secteur">
                            </div>
                        </div>

                        <div class="form-group row new-infos">
                            <div class="col-md-6 text-center" id="typeMur">
                                <input type="radio" name="climbing_type" id="voie" value="V">
                                <label for="voie">Voie</label>
                                <input type="radio" name="climbing_type" id="bloc" value="B">
                                <label for="bloc">Bloc</label>
                            </div>
                        </div>

                        <button type="submit" class="btn button-shadow" name="submit" value="Ajouter">Ajouter</button>
                        <button type="submit" class="btn button-shadow" name="submit" value="Ajouter et recommencer">
                            Ajouter et recommencer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
