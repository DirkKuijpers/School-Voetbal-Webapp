<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\MatchGame;
use Carbon\Carbon;

class MatchGeneratorController extends Controller
{
    public function generate()
    {
        MatchGame::truncate();

        $teams = Team::all()->shuffle()->values();

        $fields = [
        [
            'name' => 'Veld 1',
            'location' => 'Sportpark De Beuk'
        ],
        [
            'name' => 'Veld 2',
            'location' => 'Sportpark De Beuk'
        ],
        [
            'name' => 'Veld 3',
            'location' => 'Sportpark Olympia'
        ],
        [
            'name' => 'Veld 4',
            'location' => 'Sportpark Olympia'
        ],
        [
            'name' => 'Veld 5',
            'location' => 'Gemeenteveld Noord'
        ],
        [
            'name' => 'Veld 6',
            'location' => 'Gemeenteveld Noord'
        ],
    ];

        $matchDuration = 60;

        $startDate = Carbon::now()->addDay()->setHour(10)->setMinute(0);

        $matches = [];

        // 1. alle combinaties maken
        for ($i = 0; $i < $teams->count(); $i++) {
            for ($j = $i + 1; $j < $teams->count(); $j++) {
                $matches[] = [
                    'home' => $teams[$i],
                    'away' => $teams[$j],
                ];
            }
        }

        shuffle($matches);

        $currentDate = clone $startDate;
        $fieldIndex = 0;
        $matchesPerDay = 0;

        foreach ($matches as $match) {

            // 🕒 random tijd per dag (tussen 10:00 - 16:00)
            $hour = rand(10, 16);
            $minute = rand(0, 1) ? 0 : 30;

            $matchTime = (clone $currentDate)->setHour($hour)->setMinute($minute);

            MatchGame::create([
                'home_team_id' => $match['home']->id,
                'away_team_id' => $match['away']->id,
                'match_minutes' => 60,
                'break_minutes' => 10,
                'location' =>
                    $fields[$fieldIndex]['name'] .
                    ' - ' .
                    $fields[$fieldIndex]['location'],
                'match_time' => $matchTime,
                'played' => false,
            ]);

            // veld wisselen
            $fieldIndex++;

            if ($fieldIndex >= count($fields)) {
                $fieldIndex = 0;
            }

            $matchesPerDay++;


            if ($matchesPerDay >= 2) {
                $matchesPerDay = 0;
                $currentDate->addDay();
            }
        }

        return redirect('/schema');
    }
}
