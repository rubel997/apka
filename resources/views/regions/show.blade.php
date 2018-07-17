@extends('layouts.app')

@section('content')
    <div class="well">
        <span class="pull-right">
            <a class="btn btn-default" href="{{ route('region.edit', ['id' => $region['id']]) }}">Edytuj</a>
        </span>
        <h4>{{ __('Region') }}</h4>
        <hr>
        <div class="form-group row">
            <label class="col-xs-4 col-form-label text-md-right">{{ __('Nazwa') }}</label>

            <div class="col-xs-6">
                <label>{{ array_get($region, 'name', '-') }}</label>
            </div>
        </div>
    </div>
@endsection
