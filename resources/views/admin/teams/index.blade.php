<x-base-layout>

<div class="teams-page">

    <div class="teams-header">
        <div>
            <h1>Teams beheren</h1>
            <p>Beheer alle teams</p>
        </div>
    </div>

    <div class="teams-grid">

        @foreach($teams as $team)

            <div class="team-card">

                {{-- TEAM TOP --}}
                <div class="team-top">

                    <img src="{{ asset('storage/' . $team->image) }}"
                         alt="{{ $team->name }}">

                    <div>
                        <h2>{{ $team->name }}</h2>
                    </div>

                </div>

                {{-- SPELERS --}}
                <div class="team-players">

                    @forelse($team->users as $user)

                        <div class="player-item">
                            <div class="player-left">

                                <div class="player-avatar">
                                    {{ strtoupper(substr($user->username, 0, 1)) }}
                                </div>

                                <span>{{ $user->username }}</span>

                            </div>
                        </div>

                    @empty

                        <div class="player-item">
                            <span style="color:#6b7280; font-size:13px;">
                                Geen coach aangesteld bij dit team
                            </span>
                        </div>

                    @endforelse

                </div>

                {{-- ACTIES --}}
                <div class="team-actions">

                    <a href="{{ route('admin.teams.edit', $team->id) }}"
                       class="edit-btn">
                        Bewerken
                    </a>

                    <form method="POST"
                          action="{{ route('admin.teams.delete', $team->id) }}"
                          onsubmit="return confirm('Weet je zeker dat je dit team wilt verwijderen?')">

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="delete-btn">
                            Verwijderen
                        </button>

                    </form>

                </div>

            </div>

        @endforeach

    </div>

</div>

</x-base-layout>
