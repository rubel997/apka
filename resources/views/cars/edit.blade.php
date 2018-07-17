@extends('layouts.app')

@section('content')
    <div class="well">
        <h4>{{ __('Edytuj samochód') }}</h4>
        <hr>
        <form method="POST" action="{{ route('car.update', ['id' => $car['id']]) }}">
            {{ method_field('PUT') }}
            @csrf

            <div class="form-group row">
                <label for="car_number" class="col-md-4 col-form-label text-md-right">{{ __('Numer samochodu *') }}</label>

                <div class="col-md-6">
                    <input id="car_number" type="text" class="form-control{{ $errors->has('car_number') ? ' is-invalid' : '' }}"
                           name="car_number" value="{{ empty(old('car_number')) ? array_get($car, 'car_number') : old('car_number') }}" required autofocus>

                    @if ($errors->has('car_number'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('car_number') }}</strong>
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
