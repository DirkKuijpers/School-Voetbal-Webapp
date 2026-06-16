<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\MatchGame;

class StandController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        $matches = MatchGame::where('played', true)->get();

        $stand = [];

        // 🔥 INIT TEAMS
        foreach ($teams as $team) {
            $stand[$team->id] = [
                'team' => $team,
                'played' => 0,
                'wins' => 0,
                'draws' => 0,
                'losses' => 0,
                'goals_for' => 0,
                'goals_against' => 0,
                'goal_difference' => 0,
                'points' => 0,
            ];
        }

        // 🔥 MATCHES VERWERKEN
        foreach ($matches as $match) {

            $home = $match->home_team_id;
            $away = $match->away_team_id;

            // ⚠️ BELANGRIJK: force int (anders bugs met null)
            $homeGoals = (int) $match->home_score;
            $awayGoals = (int) $match->away_score;

            $stand[$home]['played']++;
            $stand[$away]['played']++;

            $stand[$home]['goals_for'] += $homeGoals;
            $stand[$home]['goals_against'] += $awayGoals;

            $stand[$away]['goals_for'] += $awayGoals;
            $stand[$away]['goals_against'] += $homeGoals;

            if ($homeGoals > $awayGoals) {

                $stand[$home]['wins']++;
                $stand[$home]['points'] += 3;

                $stand[$away]['losses']++;

            } elseif ($homeGoals < $awayGoals) {

                $stand[$away]['wins']++;
                $stand[$away]['points'] += 3;

                $stand[$home]['losses']++;

            } else {

                $stand[$home]['draws']++;
                $stand[$away]['draws']++;

                $stand[$home]['points'] += 1;
                $stand[$away]['points'] += 1;
            }

            // 🔥 DIRECT GOAL DIFFERENCE UPDATEN
            $stand[$home]['goal_difference'] =
                $stand[$home]['goals_for'] - $stand[$home]['goals_against'];

            $stand[$away]['goal_difference'] =
                $stand[$away]['goals_for'] - $stand[$away]['goals_against'];
        }

        // 🔥 SORTEREN (PUNTEN → DOELSALDO)
        usort($stand, function ($a, $b) {

            if ($a['points'] === $b['points']) {

                return $b['goal_difference'] <=> $a['goal_difference'];
            }

            return $b['points'] <=> $a['points'];
        });

        return view('stand', compact('stand'));
    }
}
