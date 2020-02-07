@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card formContainer">
                <div class="card-header formTitle font-size-head-form">{{ __('Informations') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('set_update_profile') }}">
                        {{csrf_field()}}

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right font-size-text">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control font-size-text @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right font-size-text">{{ __('Prénom') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control font-size-text @error('firstname') is-invalid @enderror" name="firstname" value="{{ $user->firstname }}" required autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right font-size-text">{{ __('Adresse mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control font-size-text @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn button-shadow font-size-text">
                                    {{ __('Changer informations') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('set_update_profile') }}">
                        {{csrf_field()}}

                        <div class="form-group row">
                            <label for="old_password" class="col-md-4 col-form-label text-md-right font-size-text">{{ __('Ancien mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="old_password" type="password" class="form-control font-size-text @error('old_password') is-invalid @enderror" name="old_password" required autocomplete="new-password">

                                @error('old_password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="new_password" class="col-md-4 col-form-label text-md-right font-size-text">{{ __('Nouveau mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control font-size-text @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirm" class="col-md-4 col-form-label text-md-right font-size-text">{{ __('Confirmer mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password_confirm" type="password" class="form-control font-size-text" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn button-shadow font-size-text">
                                    {{ __('Changer le mot de passe') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if(session('updated'))
    <div class="alert alert-success popup font-size-text" id="profileModification">
        {{ session('updated') }}
    </div>
@endif

@endsection
