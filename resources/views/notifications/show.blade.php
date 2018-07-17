@extends('layouts.app')

@section('content')
    <div class="well">
        <span class="pull-right">
            @if (App\Services\RoleService::checkRole(App\Services\RoleService::DIRECTOR))
                <a class="btn btn-default" href="{{ route('notification.assign.worker', ['notification' => $notification['id']]) }}">Przypisz pracownika</a>
            @endif
        </span>
        <h4>{{ __('Zgłoszenia') }}</h4>
        <hr>
        <div class="form-group row">
            <label class="col-xs-4 col-form-label text-md-right">{{ __('Klient') }}</label>

            <div class="col-xs-6">
                <label>{{ !empty($notification['client']) ? sprintf('%s %s', $notification['client']['name'], $notification['client']['last_name']) : '-'}}</label>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-4 col-form-label text-md-right">{{ __('Pracownik') }}</label>

            <div class="col-xs-6">
                <label>{{ !empty($notification['worker']) ? sprintf('%s %s', $notification['worker']['name'], $notification['worker']['last_name']) : '-'}}</label>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-4 col-form-label text-md-right">{{ __('Opis') }}</label>

            <div class="col-xs-6">
                <label>{{ array_get($notification, 'description', '-') }}</label>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-xs-4 col-form-label text-md-right">{{ __('Status') }}</label>

            <div class="col-xs-6">
                <label>{{ App\Services\StatusService::$statusesNames[$notification['status']] }}</label>
            </div>
        </div>
    </div>
@endsection
