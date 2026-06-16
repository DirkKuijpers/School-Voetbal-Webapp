<?php

namespace App\Http\Controllers;

use App\Models\MatchGame;
use App\Models\Team;

class PlayerDashboardController extends Controller
{
    public function index()
    {
        $team = auth()->user()->team;

        if (!$team) {
            return view('dashboard.player', [
                'nextMatch' => null,
                'wins' => 0,
                'draws' => 0,
                'losses' => 0,
                'goalDifference' => 0,
                'rank' => null
            ]);
        }

        // NEXT MATCH
        $nextMatch = MatchGame::where(function ($query) use ($team) {

            $query->where('home_team_id', $team->id)
                  ->orWhere('away_team_id', $team->id);

        })
        ->whereNull('home_score')
        ->orderBy('id')
        ->first();

        // STATS TEAM
        $wins = 0;
        $draws = 0;
        $losses = 0;
        $goalDifference = 0;

        $matches = MatchGame::where(function ($query) use ($team) {

            $query->where('home_team_id', $team->id)
                  ->orWhere('away_team_id', $team->id);

        })
        ->whereNotNull('home_score')
        ->whereNotNull('away_score')
        ->get();

        foreach ($matches as $match) {

            $isHome = $match->home_team_id == $team->id;

            $goalsFor = $isHome
                ? $match->home_score
                : $match->away_score;

            $goalsAgainst = $isHome
                ? $match->away_score
                : $match->home_score;

            $goalDifference += ($goalsFor - $goalsAgainst);

            if ($goalsFor > $goalsAgainst) {
                $wins++;
            }
            elseif ($goalsFor < $goalsAgainst) {
                $losses++;
            }
            else {
                $draws++;
            }
        }

        // =========================
        // 🔥 RANKING FIX
        // =========================

        $allTeams = Team::all();

        $stand = [];

        foreach ($allTeams as $t) {

            $teamMatches = MatchGame::where(function ($q) use ($t) {
                $q->where('home_team_id', $t->id)
                  ->orWhere('away_team_id', $t->id);
            })
            ->whereNotNull('home_score')
            ->whereNotNull('away_score')
            ->get();

            $points = 0;

            foreach ($teamMatches as $match) {

                $isHome = $match->home_team_id == $t->id;

                $home = $match->home_score;
                $away = $match->away_score;

                if ($home == $away) {
                    $points += 1;
                }
                elseif (
                    ($isHome && $home > $away) ||
                    (!$isHome && $away > $home)
                ) {
                    $points += 3;
                }
            }

            $stand[] = [
                'team_id' => $t->id,
                'points' => $points
            ];
        }

        usort($stand, function ($a, $b) {
            return $b['points'] <=> $a['points'];
        });

        $rank = 1;

        foreach ($stand as $i => $item) {
            if ($item['team_id'] == $team->id) {
                $rank = $i + 1;
                break;
            }
        }

        return view('dashboard.player', compact(
            'nextMatch',
            'wins',
            'draws',
            'losses',
            'goalDifference',
            'rank'
        ));
    }
}
