@extends('layouts.app')

@section('content')
    <div class="well">
        @if (App\Services\RoleService::hasWritePermission('region'))
            <span class="pull-right"><a class="btn btn-default" href="{{ route('region.create') }}">Dodaj Region</a></span>
        @endif
        <h4>Regiony</h4>
        <hr>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <td scope="col">#</td>
                    <th scope="col">Nazwa</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($regions as $key => $region)
                    <tr data-url="{{ route('region.show', ['id' => $region['id']]) }}">
                        <td scope="row">{{ $key + 1 }}</td>
                        <td>{{ $region['name'] }}</td>
                        <td>
                            <form action="{{ route('region.destroy', ['id' => $region['id']]) }}" method="POST">
                                <input type="hidden" name="_method" value="DELETE">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="{{ __('Usuń') }}">
                                    <i class="fas fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @if (count($regions) == 0)
                    <tr>
                        <td colspan="3" class="text-center">{{ __('Brak danych') }}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
