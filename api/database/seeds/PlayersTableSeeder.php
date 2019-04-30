<?php

use Illuminate\Database\Seeder;

class PlayersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // should be a large enough number to have plenty of all kinds of players
        factory(\App\Player::class, 600)->create();
    }
}
