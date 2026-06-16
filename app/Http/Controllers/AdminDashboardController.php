<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\MatchGame;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $teamsCount = Team::count();
        $usersCount = User::count();

        $playedMatches = MatchGame::whereNotNull('home_score')
            ->whereNotNull('away_score')
            ->count();

        $latestMatches = MatchGame::with(['homeTeam', 'awayTeam'])
            ->whereNotNull('home_score')
            ->whereNotNull('away_score')
            ->orderBy('id', 'desc')
            ->limit(5)
            ->get();

        return view('dashboard.admin', compact(
            'teamsCount',
            'usersCount',
            'playedMatches',
            'latestMatches'
        ));
    }
}
