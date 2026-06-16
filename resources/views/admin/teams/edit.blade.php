<x-base-layout>

<div class="team-edit-layout">

    {{-- HEADER --}}
    <div class="team-edit-header">

        <div>
            <h1>{{ $team->name }}</h1>
            <p>Team beheren en instellingen aanpassen</p>
        </div>

        <form method="POST"
              action="{{ route('admin.teams.delete', $team->id) }}">
            @csrf
            @method('DELETE')

            <button class="danger-btn">
                Team verwijderen
            </button>
        </form>

    </div>

    {{-- GRID --}}
    <div class="team-edit-grid">

        {{-- LEFT: TEAM INFO --}}
        <div class="panel">

            <h2>Team info</h2>

            <form method="POST"
                  action="{{ route('admin.teams.update', $team->id) }}"
                  enctype="multipart/form-data">

                @csrf

                <label>Team naam</label>
                <input type="text" name="name" value="{{ $team->name }}">

                <label>Logo</label>

                <div class="logo-box">
                    <img src="{{ asset('storage/' . $team->image) }}">
                </div>

                <input type="file" name="image">

                <button class="save-btn">
                    Opslaan
                </button>

            </form>

        </div>

        {{-- RIGHT: COACH --}}
        <div class="panel">

            <h2>Coach</h2>

            @if($team->coach)

                <div class="coach-card">

                    <div class="coach-avatar">
                        {{ strtoupper(substr($team->coach->username, 0, 1)) }}
                    </div>

                    <div>
                        <strong>{{ $team->coach->username }}</strong>
                        <p>coach</p>
                    </div>

                </div>

            @else

                <p class="muted">Geen coach gekoppeld</p>

            @endif

        </div>

    </div>

</div>

</x-base-layout>
