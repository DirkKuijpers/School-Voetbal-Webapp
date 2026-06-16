<x-base-layout>

<div class="schema-page">

    <div class="schema-header">

        <h1>Wedstrijdschema</h1>

        @auth
            @if(auth()->user()->role === 'admin')

                <a href="{{ route('admin.generate.matches') }}"
                   class="generate-btn">

                    Genereer wedstrijden

                </a>

            @endif
        @endauth

    </div>

    <div class="schema-container">

        @foreach($matches as $match)

            <div class="match-card"
                 onclick="openPopup({{ $match->id }})"
                 style="cursor:pointer;">

                {{-- STATUS --}}
                <div class="status">

                    @if($match->played)
                        <span class="status-played">GESPEELD</span>
                    @else
                        <span class="status-upcoming">GEPLAND</span>
                    @endif

                </div>

                {{-- TEAMS --}}
                <div class="teams">

                    {{-- HOME --}}
                    <div class="team">

                        <img src="{{ asset('storage/' . $match->homeTeam->image) }}">

                        <h3>{{ $match->homeTeam->name }}</h3>

                        {{-- SCORERS HOME --}}
                        @if($match->played && $match->home_scorers)
                            <div class="scorers">
                                @foreach(explode(',', $match->home_scorers) as $scorer)
                                    <span>⚽ {{ trim($scorer) }}</span>
                                @endforeach
                            </div>
                        @endif

                    </div>

                    {{-- CENTER --}}
                    <div class="center">

                        @if($match->played)

                            <div class="big-score">
                                {{ $match->home_score }} - {{ $match->away_score }}
                            </div>

                            <div class="small-text">
                                Eindstand
                            </div>

                        @else

                            <div class="vs-text">VS</div>

                        @endif

                    </div>

                    {{-- AWAY --}}
                    <div class="team">

                        <img src="{{ asset('storage/' . $match->awayTeam->image) }}">

                        <h3>{{ $match->awayTeam->name }}</h3>

                        {{-- SCORERS AWAY --}}
                        @if($match->played && $match->away_scorers)
                            <div class="scorers">
                                @foreach(explode(',', $match->away_scorers) as $scorer)
                                    <span>⚽ {{ trim($scorer) }}</span>
                                @endforeach
                            </div>
                        @endif

                    </div>

                </div>

                {{-- INFO --}}
                <div class="info">

                    <p>📍 {{ $match->location }}</p>

                    <p>
                        📅 {{ \Carbon\Carbon::parse($match->match_time)->format('d-m-Y') }}
                    </p>

                    <p>
                        ⏰ {{ \Carbon\Carbon::parse($match->match_time)->format('H:i') }}
                    </p>

                    <p>
                        ⏱️ {{ $match->match_minutes }} min + {{ $match->break_minutes }} min rust
                    </p>

                </div>

            </div>

            {{-- POPUP (ADMIN ONLY) --}}
            @auth
                @if(auth()->user()->role === 'admin')

                    <div class="popup-overlay"
                         id="popup-{{ $match->id }}">

                        <div class="popup">

                            <h2>
                                {{ $match->homeTeam->name }}
                                vs
                                {{ $match->awayTeam->name }}
                            </h2>

                            <form action="{{ route('admin.match.score', $match->id) }}"
                                  method="POST">

                                @csrf

                                <div class="popup-score">

                                    <input type="number"
                                           name="home_score"
                                           value="{{ $match->home_score }}"
                                           min="0">

                                    <span>-</span>

                                    <input type="number"
                                           name="away_score"
                                           value="{{ $match->away_score }}"
                                           min="0">

                                </div>

                                <textarea name="home_scorers"
                                          placeholder="Doelpuntenmakers thuisteam">{{ $match->home_scorers }}</textarea>

                                <textarea name="away_scorers"
                                          placeholder="Doelpuntenmakers uitteam">{{ $match->away_scorers }}</textarea>

                                <button type="submit">
                                    Opslaan
                                </button>

                            </form>

                            <button class="close-btn"
                                    type="button"
                                    onclick="closePopup({{ $match->id }})">

                                Sluiten

                            </button>

                        </div>

                    </div>

                @endif
            @endauth

        @endforeach

    </div>

</div>

<script>

function openPopup(id)
{
    const popup = document.getElementById('popup-' + id);

    if(!popup) return;

    popup.classList.add('active');
}

function closePopup(id)
{
    const popup = document.getElementById('popup-' + id);

    if(!popup) return;

    popup.classList.remove('active');
}

// click outside to close
window.addEventListener('click', function(event)
{
    document.querySelectorAll('.popup-overlay').forEach(popup => {

        if(event.target === popup)
        {
            popup.classList.remove('active');
        }

    });
});

</script>

</x-base-layout>
