@extends('layouts.app')

@section('content')
    <div class="well">
        @if (App\Services\RoleService::hasWritePermission('car'))
            <span class="pull-right"><a class="btn btn-default" href="{{ route('car.create') }}">Dodaj Samochód</a></span>
        @endif
        <h4>Samochody</h4>
        <hr>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <td scope="col">#</td>
                    <th scope="col">Numer samochodu</th>
                    <th scope="col">Wynajęty od</th>
                    <th scope="col">Wynajęty do</th>
                    <th scope="col">Użytkownik</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($cars as $key => $car)
                    <tr data-url="{{ route('car.show', ['id' => $car['id']]) }}">
                        <td scope="row">{{ $key + 1 }}</td>
                        <td>{{ array_get($car, 'car_number', '-') }}</td>
                        <td>{{ array_get($car, 'from_date', '-') }}</td>
                        <td>{{ array_get($car, 'to_date', '-') }}</td>
                        <td>{{ !empty($car['user']) ? sprintf('%s %s', $car['user']['name'], $car['user']['last_name']) : '-'}}</td>
                        @if (auth()->user()->role == App\Services\RoleService::WORKER && $car->isRent())
                            <td>
                                <form action="{{ route('car.rentCar', ['car' => $car['id']]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-default" data-toggle="tooltip" title="{{ (!empty($car->from_date) && empty($car->to_date)) ?  __('Oddaj samochód') : __('Wypożycz samochód') }}">
                                        <i class="fas {{ (!empty($car->from_date) && empty($car->to_date)) ? 'fa-undo' : 'fa-download' }}"></i>
                                    </button>
                                </form>
                            </td>
                        @endif
                        @if (auth()->user()->role < App\Services\RoleService::WORKER)
                            <td>
                                <form action="{{ route('car.destroy', ['id' => $car['id']]) }}" method="POST">
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
                @if (count($cars) == 0)
                    <tr>
                        <td colspan="6" class="text-center">{{ __('Brak danych') }}</td>
                    </tr>
                @endif
                </tbody>
            </table>
        </div>
    </div>
@endsection
