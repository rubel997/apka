@extends('layouts.app')

@section('content')
    <div class="well">
        @if (App\Services\RoleService::hasWritePermission('street'))
            <span class="pull-right"><a class="btn btn-default" href="{{ route('street.create') }}">Dodaj ulice</a></span>
        @endif
        <h4>Ulice</h4>
        <hr>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <td scope="col">#</td>
                    <th scope="col">Nazwa</th>
                    <th scope="col">Region</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($streets as $key => $street)
                    <tr data-url="{{ route('street.show', ['id' => $street['id']]) }}">
                        <td scope="row">{{ $key + 1 }}</td>
                        <td>{{ $street['name'] }}</td>
                        <td>
                            {{ !empty($street['region']) ? $street['region']['name'] :  '-' }}
                        </td>
                        <td>
                            <form action="{{ route('street.destroy', ['id' => $street['id']]) }}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="{{ __('Usuń') }}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @if (count($streets) == 0)
                    <tr>
                        <td colspan="4" class="text-center">{{ __('Brak danych') }}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
