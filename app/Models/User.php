<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username',
        'password',
        'team_id',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
