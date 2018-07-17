@if (Route::has('login'))
    @auth
        <li class="{{ request()->is('home') ? 'active' : '' }}">
            <a href="{{ url('/home') }}">Strona główna</a>
        </li>
        @if (App\Services\RoleService::hasReadPermission('user'))
            <li class="{{ request()->is('user*') ? 'active' : '' }}">
                <a href="{{ route('user.index') }}">Użytkownicy</a>
            </li>
        @endif
        @if (App\Services\RoleService::hasReadPermission('street'))
            <li class="{{ request()->is('street*') ? 'active' : '' }}">
                <a href="{{ route('street.index') }}">Ulice</a>
            </li>
        @endif
        @if (App\Services\RoleService::hasReadPermission('region'))
            <li class="{{ request()->is('region*') ? 'active' : '' }}">
                <a href="{{ route('region.index') }}">Regiony</a>
            </li>
        @endif
        @if (App\Services\RoleService::hasReadPermission('car'))
            <li class="{{ request()->is('car*') ? 'active' : '' }}">
                <a href="{{ route('car.index') }}">Samochody</a>
            </li>
        @endif
        @if (App\Services\RoleService::hasReadPermission('notification'))
            <li class="{{ request()->is('notification*') ? 'active' : '' }}">
                <a href="{{ route('notification.index') }}">Zgłoszenia</a>
            </li>
        @endif
        @if (App\Services\RoleService::hasReadPermission('invoice'))
            <li class="{{ request()->is('invoice*') ? 'active' : '' }}">
                <a href="{{ route('invoice.index') }}">Faktury</a>
            </li>
        @endif
    @endauth
@endif
