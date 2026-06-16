<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|unique:users',
            'password' => 'required|confirmed|min:6',
            'team_name' => 'required|string|max:255',
            'team_logo' => 'nullable|image|max:2048',
        ]);

        // 🔥 TEAM MAKEN
        $team = Team::create([
            'name' => $request->team_name,
            'image' => $request->team_logo
                ? $request->team_logo->store('teams', 'public')
                : null,
        ]);

        // 🔥 USER MAKEN EN KOPPELEN AAN TEAM
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'team_id' => $team->id,
        ]);

        return redirect()->route('login')
            ->with('status', 'Team en account succesvol aangemaakt!');
    }
}
