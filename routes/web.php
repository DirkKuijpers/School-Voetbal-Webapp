<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\StandController;
use App\Http\Controllers\Admin\MatchController;
use App\Http\Controllers\Admin\MatchGeneratorController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerDashboardController;
use App\Http\Controllers\AdminDashboardController;
/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/

Route::get('/', fn () => view('index'))
    ->middleware('guest')
    ->name('homepage');

/*
|--------------------------------------------------------------------------
| REGISTER
|--------------------------------------------------------------------------
*/

Route::post('/register', [RegisteredUserController::class, 'store'])
    ->name('register');

/*
|--------------------------------------------------------------------------
| OPENBARE PAGINA'S
|--------------------------------------------------------------------------
*/

Route::get('/schema', function () {

    $matches = \App\Models\MatchGame::with([
        'homeTeam',
        'awayTeam'
    ])->get();

    return view('schema', compact('matches'));

})->name('schema');

Route::get('/stand', [StandController::class, 'index'])
    ->name('stand');

/*
|--------------------------------------------------------------------------
| AUTH USERS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/team', [TeamController::class, 'myTeam'])
        ->name('team.my');

    Route::post('/team/leave', [TeamController::class, 'leaveTeam'])
        ->name('team.leave');

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/dashboard/admin', [AdminDashboardController::class, 'index'])
        ->name('dashboard.admin');

    Route::get('/admin/generate-matches', [MatchGeneratorController::class, 'generate'])
        ->name('admin.generate.matches');

    Route::post('/admin/match/{id}/score', [MatchController::class, 'setScore'])
        ->name('admin.match.score');

    Route::get('/admin/teams', [TeamController::class, 'index'])
        ->name('admin.teams');

    Route::get('/admin/teams/{id}', [TeamController::class, 'edit'])
        ->name('admin.teams.edit');

    Route::post('/admin/teams/{id}', [TeamController::class, 'update'])
        ->name('admin.teams.update');

    Route::delete('/admin/teams/{id}', [TeamController::class, 'delete'])
        ->name('admin.teams.delete');

});

/*
|--------------------------------------------------------------------------
| PLAYER DASHBOARD
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'player'])->group(function () {

    Route::get('/dashboard/player', [PlayerDashboardController::class, 'index'])
        ->name('dashboard.player');
});

Route::middleware(['auth'])->group(function () {

    Route::post('/team/update', [TeamController::class, 'updateMyTeam'])
        ->name('team.update');

});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';
