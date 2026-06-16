<?php

namespace App\Services;

use App\Models\Team;
use App\Models\MatchGame;

class StandingsService
{
    public function recalculate()
    {
        $teams = Team::all();
        $matches = MatchGame::where('played', true)->get();

        $stand = [];

        foreach ($teams as $team) {
            $stand[$team->id] = [
                'team' => $team,
                'played' => 0,
                'wins' => 0,
                'draws' => 0,
                'losses' => 0,
                'goals_for' => 0,
                'goals_against' => 0,
                'points' => 0,
            ];
        }

        foreach ($matches as $match) {

            $home = $match->home_team_id;
            $away = $match->away_team_id;

            $hg = (int) $match->home_score;
            $ag = (int) $match->away_score;

            $stand[$home]['played']++;
            $stand[$away]['played']++;

            $stand[$home]['goals_for'] += $hg;
            $stand[$home]['goals_against'] += $ag;

            $stand[$away]['goals_for'] += $ag;
            $stand[$away]['goals_against'] += $hg;

            if ($hg > $ag) {

                $stand[$home]['wins']++;
                $stand[$home]['points'] += 3;

                $stand[$away]['losses']++;

            } elseif ($hg < $ag) {

                $stand[$away]['wins']++;
                $stand[$away]['points'] += 3;

                $stand[$home]['losses']++;

            } else {

                $stand[$home]['draws']++;
                $stand[$away]['draws']++;

                $stand[$home]['points'] += 1;
                $stand[$away]['points'] += 1;
            }
        }

        // sort ranking
        usort($stand, function ($a, $b) {

            if ($a['points'] === $b['points']) {
                return ($b['goals_for'] - $b['goals_against'])
                     <=> ($a['goals_for'] - $a['goals_against']);
            }

            return $b['points'] <=> $a['points'];
        });

        // optioneel: cache of session
        session(['standings' => $stand]);

        return $stand;
    }
}
