@extends('layouts.app')

@section('content')
    <div class="well">
        <h4>Faktury</h4>
        <hr>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <td scope="col">#</td>
                    <th scope="col">Numer faktury</th>
                    <th scope="col">Zgłoszenie</th>
                    <th scope="col">Data</th>
                    <th scope="col">Suma na fakturze</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $key => $invoice)
                    <tr>
                        <td scope="row">{{ $key + 1 }}</td>
                        <td>{{ $invoice['invoice_number'] }}
                            <a class="btn btn-link btn-sm btn-default" data-toggle="tooltip" title="{{ __('Pobierz fakturę') }}" href="{{ route('invoice.generate', ['id' => $invoice['id']]) }}"><i class="fa fa-download"></i></a>
                        </td>
                        <td>{{ $invoice['notification_id'] }}</td>
                        <td>{{ $invoice['date'] }}</td>
                        <td>{{ $invoice['sum'] }} zł</td>
                        @if (auth()->user()->role < App\Services\RoleService::CLIENT)
                            <td>
                                <form action="{{ route('invoice.destroy', ['id' => $invoice['id']]) }}" method="POST">
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
                @if (count($invoices) == 0)
                    <tr>
                        <td colspan="6" class="text-center">{{ __('Brak danych') }}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
