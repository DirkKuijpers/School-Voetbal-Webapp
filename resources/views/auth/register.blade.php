<x-base-layout>

<div class="auth-page">

    <div class="auth-card">

        <h2>Team Registratie</h2>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf

            <!-- USER INFO -->
            <input type="text" name="username" placeholder="Gebruikersnaam" required>

            <input type="password" name="password" placeholder="Wachtwoord" required>

            <input type="password" name="password_confirmation" placeholder="Bevestig Wachtwoord" required>

            <!-- TEAM INFO -->
            <hr style="margin: 15px 0; border: 1px solid #eee;">

            <input type="text" name="team_name" placeholder="Team naam" required>

            <label style="font-size: 13px; margin-bottom: 6px; display:block;">
                Team logo
            </label>

            <input type="file" name="team_logo" accept="image/*">

            <button type="submit" style="margin-top: 15px;">
                Team registreren
            </button>

        </form>

    </div>

</div>

</x-base-layout>
