@auth

<div class="navbar">

    <div class="nav-left">

        <a href="{{ auth()->user()->role === 'admin'
            ? route('dashboard.admin')
            : route('dashboard.player') }}"
           class="logo">

            <img src="{{ asset('img/logo-header.png') }}" alt="Schoolvoetbal">

        </a>

        <a href="{{ auth()->user()->role === 'admin'
            ? route('dashboard.admin')
            : route('dashboard.player') }}">
            Dashboard
        </a>

        <a href="{{ route('schema') }}">Schema</a>

        <a href="{{ route('stand') }}">Stand</a>

        @if(auth()->user()->role === 'admin')

    <a href="{{ route('admin.teams') }}">
            Teams Beheren
        </a>

    @else

        <a href="{{ route('team.my') }}">
            Mijn Team
        </a>

    @endif

    </div>

    <div class="nav-right">

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="nav-btn outline">
                Uitloggen
            </button>

        </form>

    </div>

</div>

@endauth
