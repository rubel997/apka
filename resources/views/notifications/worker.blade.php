@extends('layouts.app')

@section('content')
    <div class="well">
        <h4>{{ __('Przypisz pracownika') }}</h4>
        <hr>
        <form method="POST" action="{{ route('notification.store.worker', ['notification' => $notification['id']]) }}">
            @csrf

            <div class="form-group row">
                <label for="worker_id" class="col-md-4 col-form-label text-md-right">{{ __('Pracownik *') }}</label>

                <div class="col-md-6">
                    <select class="form-control" id="worker_id" name="worker_id">
                        <option value="" selected disabled hidden>--Wybierz opcję--</option>

                        @foreach($workers as $worker)
                            <option value="{{$worker['id']}}">{{sprintf('%s %s', $worker['name'], $worker['last_name'])}}</option>
                        @endforeach
                    </select>

                    @if ($errors->has('worker_id'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('worker_id') }}</strong>
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
