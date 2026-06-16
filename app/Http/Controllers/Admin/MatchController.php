<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MatchGame;
use Illuminate\Http\Request;
use App\Services\StandingsService;

class MatchController extends Controller
{
    public function setScore(Request $request, $id)
    {
        $match = MatchGame::findOrFail($id);

        $request->validate([
            'home_score' => 'required|integer|min:0',
            'away_score' => 'required|integer|min:0',
        ]);

        // 🔥 SAVE SCORE + STATUS
        $match->home_score = $request->home_score;
        $match->away_score = $request->away_score;
        $match->played = true;

        // scorers (optioneel)
        $match->home_scorers = $request->home_scorers;
        $match->away_scorers = $request->away_scorers;

        $match->save();

        // 🔥 IMPORTANT: HERBEREKEN STAND
        app(StandingsService::class)->recalculate();

        return redirect()->back()->with('success', 'Score opgeslagen en stand geüpdatet!');
    }

    public function index()
    {
        return view('schema');
    }
}
