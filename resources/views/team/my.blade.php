<x-base-layout>

<div class="team-hub">

    {{-- HERO --}}
    <div class="team-hero">

        @if($team)

            <div class="team-hero-card">

                <img class="team-logo-large"
                     src="{{ asset('storage/' . $team->image) }}"
                     alt="team logo">

                <div class="team-hero-text">

                    <h1>{{ $team->name }}</h1>

                    <p>Jouw team in het toernooi</p>

                    <span class="badge">
                         {{ auth()->user()->username }}
                    </span>

                </div>

            </div>

        @else

            <div class="empty-state">
                <h1>Je zit nog niet in een team</h1>
                <p>Je coach moet je eerst toevoegen</p>
            </div>

        @endif

    </div>

    @if($team)

    {{-- CONTENT --}}
    <div class="team-grid">

        {{-- TEAM EDIT --}}
        <div class="team-card main">

            <h2>Team beheren</h2>

            <form method="POST"
                  action="{{ route('team.update') }}"
                  enctype="multipart/form-data">

                @csrf

                <label>Team naam</label>
                <input type="text"
                       name="name"
                       value="{{ $team->name }}">

                <label>Logo</label>
                <input type="file" name="image">

                <button class="btn-primary">
                    Opslaan
                </button>

            </form>

        </div>

        {{-- INFO --}}
        <div class="team-card">

            <h2>Info</h2>

            <p><strong>Status:</strong> Actief</p>

        </div>

        {{-- DANGER --}}
        <div class="team-card danger">

            <h2>Hier kan je je Uitschrijven van het toernooi</h2>

            <p></p>

            <form method="POST" action="{{ route('team.leave') }}">
                @csrf

                <button class="btn-danger">
                    Uitschrijven
                </button>

            </form>

        </div>

    </div>

    @endif

</div>

</x-base-layout>
