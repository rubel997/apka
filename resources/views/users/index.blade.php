@extends('layouts.app')

@section('content')
    <div class="well">
        @if (App\Services\RoleService::hasWritePermission('user'))
            <span class="pull-right"><a class="btn btn-default" href="{{ route('user.create') }}">Dodaj użytkownika</a></span>
        @endif
        <h4>Użytkownicy</h4>
        <hr>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <td scope="col">#</td>
                    <th scope="col">Imię</th>
                    <th scope="col">Nazwisko</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Telefon</th>
                    <th scope="col">Adres</th>
                    <th scope="col">Rola</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $key => $user)
                    <tr data-url="{{ route('user.show', ['id' => $user['id']]) }}">
                        <td scope="row">{{ $key + 1 }}</td>
                        <td>{{ array_get($user, 'name', '-') }}</td>
                        <td>{{ array_get($user, 'last_name', '-') }}</td>
                        <td>{{ array_get($user, 'email', '-') }}</td>
                        <td>{{ array_get($user, 'phone_number', '-') }}</td>
                        <td>
                            {{ !empty($user['street']) ? $user['street']['name'] . ' ' . array_get($user, 'house_number') : '-' }}
                        </td>
                        <td>{{ App\Services\RoleService::getPermissionName(array_get($user, 'role')) }}</td>
                        <td>
                            <form action="{{ route('user.destroy', ['id' => $user['id']]) }}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="{{ __('Usuń') }}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @if (count($users) == 0)
                    <tr>
                        <td colspan="8" class="text-center">{{ __('Brak danych') }}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
