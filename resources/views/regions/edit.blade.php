@extends('layouts.app')

@section('content')
    <div class="well">
        <h4>{{ __('Edytuj region') }}</h4>
        <hr>
        <form method="POST" action="{{ route('region.update', ['id' => $region['id']]) }}">
            {{ method_field('PUT') }}
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nazwa *') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           name="name" value="{{ empty(old('name')) ? array_get($region, 'name') : old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Zapisz') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
