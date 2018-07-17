@extends('layouts.app')

@section('content')
    <div class="well">
        @if (App\Services\RoleService::hasWritePermission('notification'))
            <span class="pull-right"><a class="btn btn-default" href="{{ route('notification.create') }}">Dodaj Zgłoszenie</a></span>
        @endif
        <h4>Zgłoszenia</h4>
        <hr>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <td scope="col">#</td>
                    <th scope="col">Status</th>
                    <th scope="col">Data</th>
                    <th scope="col">Opis</th>
                    <th scope="col">Klient</th>
                    <th scope="col">Pracownik</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($notifications as $key => $notification)
                    <tr data-url="{{ route('notification.show', ['id' => $notification['id']]) }}">
                        <td scope="row">{{ $notification['id'] }}</td>
                        <td>{{ App\Services\StatusService::$statusesNames[$notification['status']] }}</td>
                        <td>{{ $notification['date'] }}</td>
                        <td>{{ $notification['description'] }}</td>
                        <td>{{ !empty($notification['client']) ? sprintf('%s %s', $notification['client']['name'], $notification['client']['last_name']) : '-'}}</td>
                        <td>{{ !empty($notification['worker']) ? sprintf('%s %s', $notification['worker']['name'], $notification['worker']['last_name']) : '-'}}</td>
                        @if ($notification['status'] < App\Services\StatusService::COMPLETED && $notification['status'] > App\Services\StatusService::REGISTERED && auth()->user()->role == App\Services\RoleService::WORKER)
                            <td>
                                <form action="{{ route('notification.changeStatus', ['notification' => $notification['id']]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-default" data-toggle="tooltip" title="{{ __('Zmień status') }}">
                                        <i class="fas fa-exchange-alt"></i>
                                    </button>
                                </form>
                            </td>
                        @endif
                        @if ($notification['status'] < App\Services\StatusService::COMPLETED)
                            <td>
                                <form action="{{ route('notification.cancelStatus', ['notification' => $notification['id']]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-default" data-toggle="tooltip" title="{{ __('Anuluj') }}">
                                        <i class="fas fa-ban"></i>
                                    </button>
                                </form>
                            </td>
                        @endif
                        @if (auth()->user()->role < App\Services\RoleService::CLIENT)
                            <td>
                                <form action="{{ route('notification.destroy', ['id' => $notification['id']]) }}" method="POST">
                                    <input type="hidden" name="_method" value="DELETE">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" data-toggle="tooltip" title="{{ __('Usuń') }}">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </form>
                            </td>
                        @endif
                    </tr>
                @endforeach
                @if (count($notifications) == 0)
                    <tr>
                        <td colspan="7" class="text-center">{{ __('Brak danych') }}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
