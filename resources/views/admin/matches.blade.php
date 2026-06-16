@foreach($matches as $match)
    <div style="border:1px solid #ccc; padding:10px; margin-bottom:10px;">
        <strong>
            {{ $match->homeTeam->name }} vs {{ $match->awayTeam->name }}
        </strong>

        <br>

        @if($match->played)
            Score: {{ $match->home_score }} - {{ $match->away_score }}
        @else
            <form method="POST" action="/admin/match/{{ $match->id }}/score">
                @csrf

                <input type="number" name="home_score" placeholder="Home" min="0">
                -
                <input type="number" name="away_score" placeholder="Away" min="0">

                <button type="submit">Opslaan</button>
            </form>
        @endif
    </div>
@endforeach
