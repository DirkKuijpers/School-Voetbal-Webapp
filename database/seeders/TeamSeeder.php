<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        Team::truncate();

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $teams = [

            [
                'name' => 'Ajax',
                'image' => 'teams/ajax.png',
            ],

            [
                'name' => 'PSV',
                'image' => 'teams/psv.png',
            ],

            [
                'name' => 'Feyenoord',
                'image' => 'teams/feyenoord.png',
            ],

            [
                'name' => 'AZ',
                'image' => 'teams/az.png',
            ],

        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
