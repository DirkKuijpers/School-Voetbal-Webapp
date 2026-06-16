<x-base-layout>

<div class="dashboard-page">

    {{-- TOP --}}
    <div class="dashboard-top">

        <div class="welcome-card">

            <div>
                <h1>
                    Welkom,
                    {{ auth()->user()->username }}
                </h1>

                <p>
                    Bekijk je volgende wedstrijd en team statistieken
                </p>
            </div>

        </div>

    </div>

    {{-- GRID --}}
    <div class="dashboard-grid">

        {{-- VOLGENDE WEDSTRIJD --}}
        <div class="dashboard-card next-match">

            <div class="card-header">

                <h2>Volgende wedstrijd</h2>

                <a href="{{ route('schema') }}">
                    Bekijk schema
                </a>

            </div>

            @if($nextMatch)

                <div class="match-box">

                    <div class="team-side">

                        <img src="{{ asset('storage/' . $nextMatch->homeTeam->image) }}">

                        <span>
                            {{ $nextMatch->homeTeam->name }}
                        </span>

                    </div>

                    <div class="match-center">

                        <div class="vs">
                            VS
                        </div>

                        <p>
                            {{ $nextMatch->match_date }}
                        </p>

                    </div>

                    <div class="team-side">

                        <img src="{{ asset('storage/' . $nextMatch->awayTeam->image) }}">

                        <span>
                            {{ $nextMatch->awayTeam->name }}
                        </span>

                    </div>

                </div>

            @else

                <p class="muted">
                    Geen wedstrijd gevonden
                </p>

            @endif

        </div>

        {{-- STATS --}}
        <div class="dashboard-card stats-card">

            <h2>Team statistieken</h2>

            <div class="stats-grid">

                <div class="stat-box">
                    <span>{{ $wins }}</span>
                    <p>Gewonnen</p>
                </div>

                <div class="stat-box">
                    <span>{{ $draws }}</span>
                    <p>Gelijk</p>
                </div>

                <div class="stat-box">
                    <span>{{ $losses }}</span>
                    <p>Verloren</p>
                </div>

                <div class="stat-box">
                    <span>{{ $goalDifference }}</span>
                    <p>Doelsaldo</p>
                </div>

            </div>

        </div>

        {{-- RANK --}}
        <div class="dashboard-card rank-card">

            <h2>Ranglijst</h2>

            <div class="rank-number">
                #{{ $rank }}
            </div>

            <p>
                Plaats op de ranglijst
            </p>

            <a href="{{ route('stand') }}" class="rank-btn">
                Bekijk stand
            </a>

        </div>

    </div>

</div>

</x-base-layout>
