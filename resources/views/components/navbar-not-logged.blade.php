<div class="navbar">

    <div class="nav-left">
        <a href="{{ route('homepage') }}" class="logo">
            <img src="{{ asset('img/logo-header.png') }}" alt="Schoolvoetbal">
        </a>

        <a href="{{ route('homepage') }}">Home</a>
        <a href="{{ route('schema') }}">Schema</a>
        <a href="{{ route('stand') }}">Stand</a>
    </div>

    <div class="nav-right">
        <a href="{{ route('login') }}" class="nav-btn">Login</a>
        <a href="{{ route('register') }}" class="nav-btn outline">Register</a>
    </div>

</div>
