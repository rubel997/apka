@extends('layouts.app')

@section('content')
    <div class="well">
        <h4>{{ __('Edytuj użytkownika') }}</h4>
        <hr>
        <form method="POST" action="{{ route('user.update', ['id' => $user['id']]) }}">
            {{ method_field('PUT') }}
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Imię *') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           name="name" value="{{ empty(old('name')) ? array_get($user, 'name') : old('name') }}" required autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Nazwisko') }}</label>

                <div class="col-md-6">
                    <input id="last_name" type="text" class="form-control{{ $errors->has('last_name') ? ' is-invalid' : '' }}"
                           name="last_name" value="{{ empty(old('last_name')) ? array_get($user, 'last_name') : old('last_name') }}">

                    @if ($errors->has('last_name'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('Numer telefonu') }}</label>

                <div class="col-md-6">
                    <input id="phone_number" type="tel" class="form-control{{ $errors->has('phone_number') ? ' is-invalid' : '' }}"
                           name="phone_number" value="{{ empty(old('phone_number')) ? array_get($user, 'phone_number') : old('phone_number') }}">

                    @if ($errors->has('phone_number'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Ulica') }}</label>

                <div class="col-md-6">
                    <input id="street" type="text" class="form-control{{ $errors->has('street') ? ' is-invalid' : '' }}"
                           name="street" value="{{ empty(old('street')) ? array_get($user['street'], 'name') : old('street') }}">

                    @if ($errors->has('street'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('street') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="house_number" class="col-md-4 col-form-label text-md-right">{{ __('Numer domu') }}</label>

                <div class="col-md-6">
                    <input id="house_number" type="text" class="form-control{{ $errors->has('house_number') ? ' is-invalid' : '' }}"
                           name="house_number" value="{{ empty(old('house_number')) ? array_get($user, 'house_number') : old('house_number') }}">

                    @if ($errors->has('house_number'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('house_number') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            @if (auth()->user()->role < App\Services\RoleService::WORKER)
                <div class="form-group row">
                    <label for="region_ids" class="col-md-4 col-form-label text-md-right">{{ __('Region') }}</label>

                    <div class="col-md-6">
                        <select class="form-control" id="region_ids" name="region_ids[]" multiple="multiple">
                            <option value="" selected disabled hidden>--Wybierz opcję--</option>

                            @foreach($regions as $region)
                                @if($region->users()->count() < App\Region::getMaxSize() || in_array($region['id'], $regionsIds))
                                    <option value="{{$region['id']}}" {{ in_array($region['id'], $regionsIds) ? 'selected' : '' }}>{{$region['name']}}</option>
                                @endif
                            @endforeach
                        </select>

                        @if ($errors->has('region_ids'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('region_ids') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            @endif

            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Adres E-Mail *') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" value="{{ empty(old('email')) ? array_get($user, 'email') : old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Hasło') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group row">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Powtórz hasło') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
                </div>
            </div>

            @if (App\Services\RoleService::checkRole(App\Services\RoleService::ADMINISTRATOR) && ($user['role'] !== App\Services\RoleService::CLIENT))
                <div class="form-group row">
                    <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Rola') }}</label>

                    <div class="col-md-6">
                        <select class="form-control" id="role" name="role">
                            <option value="0" {{ $user['role'] == 0 ? 'selected' : '' }}>Administrator</option>
                            <option value="1" {{ $user['role'] == 1 ? 'selected' : '' }}>Kierownik</option>
                            <option value="2" {{ $user['role'] == 2 ? 'selected' : '' }}>Pracownik</option>
                        </select>

                        @if ($errors->has('role'))
                            <span class="invalid-feedback">
                            <strong>{{ $errors->first('role') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>
            @endif

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
