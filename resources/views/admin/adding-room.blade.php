@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card formContainer">
                <div class="card-header formTitle">{{ __('Ajouter une ou plusieurs salles') }}</div>
                <div class="card-body">
                    <form method="post" action="{{route('add_room')}}">
                        {{csrf_field()}}

                        <div class="form-group row new-infos">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nom Salle') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" placeholder="nom salle">
                            </div>
                        </div>

                        <div class="form-group row new-infos">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" placeholder="e-mail">
                            </div>
                        </div>

                        <div class="form-group row new-infos">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Adresse') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" placeholder="adresse">
                            </div>
                        </div>

                        <button type="submit" class="btn button-shadow" name="submit" value="Ajouter et recommencer">
                            Ajouter et recommencer
                        </button>
                        <button type="submit" class="btn button-shadow" name="submit" value="Ajouter">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

    <div>
        @if(\Session::has('add-success'))
            <div class="alert alert-success popup" id="addSuccessRoom">
                {{\Session::get('add-success')}}
            </div>
        @elseif (\Session::has('add_failure'))
            <div class="alert alert-danger popup" id="addSuccessRoom">
                {{\Session::get('add_failure')}}
            </div>
        @endif
    </div>
@endsection
