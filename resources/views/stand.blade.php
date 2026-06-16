<x-base-layout>

<div class="stand-page">

    <div class="stand-header">
        <h1>Stand</h1>
        <p>Alle teams en resultaten</p>
    </div>

    <div class="stand-table-wrapper">

        <table class="stand-table">

            <thead>
                <tr>
                    <th>#</th>
                    <th>Team</th>
                    <th>Gespeeld</th>
                    <th>W</th>
                    <th>G</th>
                    <th>V</th>
                    <th>DV</th>
                    <th>DT</th>
                    <th>DS</th>
                    <th>P</th>
                </tr>
            </thead>

            <tbody>

                @foreach($stand as $s)

                    <tr>

                        <td class="rank">{{ $loop->iteration }}</td>

                        <td class="team-cell">
                            <img src="{{ asset('storage/' . $s['team']->image) }}">
                            <span>{{ $s['team']->name }}</span>
                        </td>

                        <td>{{ $s['played'] }}</td>
                        <td>{{ $s['wins'] }}</td>
                        <td>{{ $s['draws'] }}</td>
                        <td>{{ $s['losses'] }}</td>

                        <td>{{ $s['goals_for'] }}</td>
                        <td>{{ $s['goals_against'] }}</td>

                        <td>{{ $s['goal_difference'] }}</td>

                        <td class="points">
                            {{ $s['points'] }}
                        </td>

                    </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

</x-base-layout>
