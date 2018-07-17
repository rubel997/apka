@extends('layouts.app')

@section('content')
    <div class="well">
        <span class="pull-right">
            <a class="btn btn-default" href="{{ route('street.edit', ['id' => $street['id']]) }}">Edytuj</a>
        </span>
        <h4>{{ __('Ulica') }}</h4>
        <hr>
        <div class="form-group row">
            <label class="col-xs-4 col-form-label text-md-right">{{ __('Nazwa') }}</label>

            <div class="col-xs-6">
                <label>{{ array_get($street, 'name', '-') }}</label>
            </div>
        </div>

        <div class="form-group row">
            <label class="col-xs-4 col-form-label text-md-right">{{ __('Region') }}</label>

            <div class="col-xs-6">
                <label>{{ array_get($street['region'], 'name', '-') }}</label>
            </div>
        </div>
    </div>
@endsection
