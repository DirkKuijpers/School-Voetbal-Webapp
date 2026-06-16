<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;

/*
|--------------------------------------------------------------------------
| Homepage
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('index');
})->name('homepage');

/*
|--------------------------------------------------------------------------
| Dashboard (logged in users)
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Register (TEAM + USER)
|--------------------------------------------------------------------------
*/

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

/*
|--------------------------------------------------------------------------
| Auth routes (Laravel Breeze / default auth)
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';

/*
|--------------------------------------------------------------------------
| Profile (Laravel default)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Role dashboards
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard/player', function () {
        return view('dashboard.player');
    })->name('dashboard.player');

    Route::get('/dashboard/admin', function () {
        return view('dashboard.admin');
    })->middleware('admin')->name('dashboard.admin');

});

/*
|--------------------------------------------------------------------------
| Extra pages
|--------------------------------------------------------------------------
*/

Route::get('/schema', function () {
    return view('schema');
})->name('schema');

Route::get('/stand', function () {
    return view('stand');
})->name('stand');
