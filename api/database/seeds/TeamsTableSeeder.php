<?php

use Illuminate\Database\Seeder;

class TeamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \Illuminate\Support\Facades\DB::table('teams')->delete();
        factory(\App\Team::class, count(\App\Team::TEAM_ICONS))->create();

    }
}