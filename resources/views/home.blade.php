@extends('layouts.app')

@section('content')
    @if (App\Services\RoleService::hasReadPermission('user'))
        <div class="well col-sm-4">
        <a href="{{ route('user.index') }}" class="btn btn-lg btn-default" style="width: 100%; padding-top: 75%; position: relative;">
            <div style="position: absolute; top: 30px; left: 0; right: 0; bottom: 0; text-align: center; font-size: 20px;">
                <h4>Użytkownicy</h4>
                {{--<i class="fas fa-users"></i>--}}
            </div>
        </a>
    </div>
    @endif
    @if (App\Services\RoleService::hasReadPermission('street'))
        <div class="well col-sm-4">
        <a href="{{ route('street.index') }}" class="btn btn-lg btn-default" style="width: 100%; padding-top: 75%; position: relative;">
            <div style="position: absolute; top: 30px; left: 0; right: 0; bottom: 0; text-align: center; font-size: 20px;">
                <h4>Ulice</h4>
                {{--<i class="fas fa-road"></i>--}}
            </div>
        </a>
    </div>
    @endif
    @if (App\Services\RoleService::hasReadPermission('region'))
        <div class="well col-sm-4">
        <a href="{{ route('region.index') }}" class="btn btn-lg btn-default" style="width: 100%; padding-top: 75%; position: relative;">
            <div style="position: absolute; top: 30px; left: 0; right: 0; bottom: 0; text-align: center; font-size: 20px;">
                <h4>Regiony</h4>
                {{--<i class="fas fa-road"></i>--}}
            </div>
        </a>
    </div>
    @endif
    @if (App\Services\RoleService::hasReadPermission('car'))
        <div class="well col-sm-4">
        <a href="{{ route('car.index') }}" class="btn btn-lg btn-default" style="width: 100%; padding-top: 75%; position: relative;">
            <div style="position: absolute; top: 30px; left: 0; right: 0; bottom: 0; text-align: center; font-size: 20px;">
                <h4>Samochody</h4>
                {{--<i class="fas fa-road"></i>--}}
            </div>
        </a>
    </div>
    @endif
    @if (App\Services\RoleService::hasReadPermission('notification'))
        <div class="well col-sm-4">
        <a href="{{ route('notification.index') }}" class="btn btn-lg btn-default" style="width: 100%; padding-top: 75%; position: relative;">
            <div style="position: absolute; top: 30px; left: 0; right: 0; bottom: 0; text-align: center; font-size: 20px;">
                <h4>Zgłoszenia</h4>
                {{--<i class="fas fa-road"></i>--}}
            </div>
        </a>
    </div>
    @endif
    @if (App\Services\RoleService::hasReadPermission('invoice'))
        <div class="well col-sm-4">
        <a href="{{ route('invoice.index') }}" class="btn btn-lg btn-default" style="width: 100%; padding-top: 75%; position: relative;">
            <div style="position: absolute; top: 30px; left: 0; right: 0; bottom: 0; text-align: center; font-size: 20px;">
                <h4>Faktury</h4>
                {{--<i class="fas fa-road"></i>--}}
            </div>
        </a>
    </div>
    @endif

@endsection
