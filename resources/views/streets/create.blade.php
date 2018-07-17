@extends('layouts.app')

@section('content')
    <div class="well">
        <h4>{{ __('Dodaj ulice') }}</h4>
        <hr>
        <form method="POST" action="{{ route('street.store') }}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nazwa *') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           name="name" value="{{ old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="region_id" class="col-md-4 col-form-label text-md-right">{{ __('Region') }}</label>

                <div class="col-md-6">
                    <select class="form-control" id="region_id" name="region_id">
                        <option value="" selected disabled hidden>--Wybierz opcję--</option>

                        @foreach($regions as $region)
                            <option value="{{$region['id']}}">{{$region['name']}}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('region'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('region') }}</strong>
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
