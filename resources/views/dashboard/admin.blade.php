<x-base-layout>

<div class="admin-dashboard">

    {{-- HEADER --}}
    <div class="dashboard-header">
        <h1>Admin Dashboard</h1>
        <p>Overzicht van het toernooi</p>
    </div>

    {{-- STATS --}}
    <div class="stats-grid">

        <div class="stat-card">
            <h2>{{ $teamsCount }}</h2>
            <p>Teams</p>
        </div>

        <div class="stat-card">
            <h2>{{ $usersCount }}</h2>
            <p>Spelers</p>
        </div>

        <div class="stat-card">
            <h2>{{ $playedMatches }}</h2>
            <p>Gespeelde wedstrijden</p>
        </div>

    </div>

    {{-- QUICK ACTIONS --}}
    <div class="action-bar">

        <a href="{{ route('admin.teams') }}" class="btn-primary">
            Teams beheren
        </a>

        <a href="{{ route('admin.generate.matches') }}" class="btn-primary">
            Wedstrijden genereren
        </a>

        <a href="{{ route('schema') }}" class="btn-secondary">
            Schema bekijken
        </a>

    </div>

    {{-- RECENT MATCHES --}}
    <div class="panel">

        <h2>Laatste uitslagen</h2>

        @foreach($latestMatches as $match)

            <div class="match-row">

                <span>{{ $match->homeTeam->name }}</span>

                <strong>
                    {{ $match->home_score }} - {{ $match->away_score }}
                </strong>

                <span>{{ $match->awayTeam->name }}</span>

            </div>

        @endforeach

    </div>

</div>

</x-base-layout>
