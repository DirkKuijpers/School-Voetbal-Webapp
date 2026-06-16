<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    // ADMIN: alle teams
    public function index()
    {
        $teams = Team::with('users')->get();
        return view('admin.teams.index', compact('teams'));
    }

    // ADMIN: team detail
    public function edit($id)
    {
        $team = Team::with('users')->findOrFail($id);
        return view('admin.teams.edit', compact('team'));
    }

    // ADMIN: update team naam
    public function update(Request $request, $id)
    {
        $team = Team::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $team->update([
            'name' => $request->name,
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('teams', 'public');

            $team->image = $path;
        }

        return redirect()->route('admin.teams');
    }

    public function updateMyTeam(Request $request)
    {
        $user = auth()->user();

        if (!$user->team) {
            return back();
        }

        $team = $user->team;

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $team->update([
            'name' => $request->name,
        ]);

        if ($request->hasFile('image')) {
            $team->image = $request->file('image')->store('teams', 'public');
            $team->save();
        }

        return back()->with('success', 'Team bijgewerkt');
    }


    // ADMIN: verwijder team
    public function delete($id)
    {
        $team = Team::findOrFail($id);

        // alle users loskoppelen van dit team
        foreach ($team->users as $user) {
            $user->team_id = null;
            $user->save();
        }

        // team verwijderen
        $team->delete();

        return redirect()->route('admin.teams')
            ->with('success', 'Team en koppelingen verwijderd');
    }

    // PLAYER: eigen team
    public function myTeam()
    {
        if(auth()->user()->role === 'admin')
        {
            return redirect()->route('admin.teams');
        }

        $team = auth()->user()->team;

        return view('team.my', compact('team'));
    }


    public function editMyTeam()
    {
        $team = auth()->user()->team;

        if (!$team) {
            return redirect()->route('team.my');
        }

        return view('team.edit', compact('team'));
    }
    // PLAYER: uitschrijven uit team
    public function leaveTeam()
    {
        $user = auth()->user();

        $team = $user->team;

        if ($team) {

            // alle users loskoppelen
            foreach ($team->users as $member) {
                $member->team_id = null;
                $member->save();
            }

            // team verwijderen
            $team->delete();
        }

        return redirect()->route('stand');
    }
}
