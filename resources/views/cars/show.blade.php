@extends('layouts.app')

@section('content')
    <div class="well">
        @if (App\Services\RoleService::hasWritePermission('car'))
            <span class="pull-right">
                <a class="btn btn-default" href="{{ route('car.edit', ['id' => $car['id']]) }}">Edytuj</a>
            </span>
        @endif
        <h4>{{ __('Samochód') }}</h4>
        <hr>
        <div class="form-group row">
            <label class="col-xs-4 col-form-label text-md-right">{{ __('Numer samochodu') }}</label>

            <div class="col-xs-6">
                <label>{{ array_get($car, 'car_number', '-') }}</label>
            </div>
        </div>
    </div>
@endsection
