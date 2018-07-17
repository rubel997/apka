@extends('layouts.app')

@section('content')
    <div class="well">
        <span class="pull-right">
            <a class="btn btn-default" href="{{ route('user.edit', ['id' => $user['id']]) }}">Edytuj</a>
        </span>
        <h4>{{ __('Użytkownik') }}</h4>
        <hr>
        <div class="form-group row">
            <label class="col-xs-4 col-form-label text-md-right">{{ __('Imię') }}</label>

            <div class="col-xs-6">
                <label>{{ array_get($user, 'name', '-') }}</label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-4 col-form-label text-md-right">{{ __('Nazwisko') }}</label>

            <div class="col-xs-6">
                <label>{{ array_get($user, 'last_name', '-') }}</label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-4 col-form-label text-md-right">{{ __('Numer telefonu') }}</label>

            <div class="col-xs-6">
                <label>{{ array_get($user, 'phone_number', '-') }}</label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-4 col-form-label text-md-right">{{ __('Ulica') }}</label>

            <div class="col-xs-6">
                <label>
                    {{ !empty($user['street']) ? $user['street']['name'] . ' ' . array_get($user, 'house_number') : '-' }}
                </label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-4 col-form-label text-md-right">{{ __('Region') }}</label>

            <div class="col-xs-6">
                <label>
                    {{ implode(', ', $regions) }}
                </label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-4 col-form-label text-md-right">{{ __('Adres E-Mail') }}</label>

            <div class="col-xs-6">
                <label>{{ array_get($user, 'email', '-') }}</label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-4 col-form-label text-md-right">{{ __('Rola') }}</label>

            <div class="col-xs-6">
                <label>{{ App\Services\RoleService::getPermissionName(array_get($user, 'role', '')) }}</label>
            </div>
        </div>
    </div>
@endsection
