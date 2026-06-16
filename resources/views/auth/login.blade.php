<x-base-layout>

<div class="auth-page">

    <div class="auth-card">

        <h2>Login</h2>

        @if (session('status'))
            <div class="alert">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <input type="text" name="username" placeholder="Gebruikersnaam" required autofocus>

            @error('username')
                <div class="error">{{ $message }}</div>
            @enderror

            <input type="password" name="password" placeholder="Wachtwoord" required>

            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror



            <button type="submit">Log in</button>

        </form>

        <p style="margin-top:15px; text-align:center; font-size:14px;">
            Nog geen account?
            <a href="{{ route('register') }}">Register</a>
        </p>

    </div>

</div>

</x-base-layout>
