@extends('layouts.app')

@section('content')
    <div class="well">
        <span class="pull-right"><span class="btn btn-default" id="add">{{ __('Dodaj pole') }}</span></span>
        <h4>{{ __('Dodaj fakturę') }}</h4>
        <hr>
        <form method="POST" action="{{ route('notification.store.invoice', ['notification' => $notification['id']]) }}">
            @csrf

            <div class="form-group row">
                <label class="col-xs-8 col-form-label text-md-right">{{ __('Usługa') }}</label>
                <label class="col-xs-2 col-form-label text-md-right">{{ __('Cena') }}</label>
            </div>

            <div class="form-group row dynamic-fields">
                <label for="service_1"></label>
                <div class="col-xs-8">
                    <input id="service_1" type="text" class="form-control{{ $errors->has('service_1') ? ' is-invalid' : '' }}"
                           name="service_1" value="{{ old('service_1') }}" required autofocus>

                    @if ($errors->has('service_1'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('service_1') }}</strong>
                        </span>
                    @endif
                </div>
                <label for="price_1"></label>
                <div class="col-xs-2">
                    <input id="price_1" type="number" min="0" step="0.01" class="form-control{{ $errors->has('price_1') ? ' is-invalid' : '' }}"
                           name="price_1" value="{{ old('price_1') }}" required autofocus>

                    @if ($errors->has('price_1'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('price_1') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-primary">
                        {{ __('Dodaj') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
