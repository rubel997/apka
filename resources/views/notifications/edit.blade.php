@extends('layouts.app')

@section('content')
    <div class="well">
        <h4>{{ __('Edytuj zgłoszenie') }}</h4>
        <hr>
        <form method="POST" action="{{ route('notification.update', ['id' => $notification['id']]) }}">
            {{ method_field('PUT') }}
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Opis *') }}</label>

                <div class="col-md-6">
                    <textarea id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                              name="description" rows="10" required autofocus>{{ empty(old('description')) ? array_get($notification, 'description') : old('description') }}</textarea>

                    @if ($errors->has('description'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('description') }}</strong>
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
