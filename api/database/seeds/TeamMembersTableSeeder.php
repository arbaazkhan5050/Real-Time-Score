<?php

use Illuminate\Database\Seeder;

class TeamMembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // we're not doing this with a factory
        // factory is used to generate dummy data that is not already there.
        // we will use existing data from the DB



        /**
         * Logic:
         * -> Each team has 12 players: 11 active + 1 substitute (extra)
         * -> each team must have 4 bowlers (for our application), 3 alrounders and 4 batsmen.
         * -> We will pick an extra batsman for the 12th.
         * -> All members must be unique between teams. One player cannot be a member of another team too.
         */

        $teams = \App\Team::all();
        $pickedPlayerIds = [];

        // we loop through the teams, as those are the things we're setting players to
        foreach ($teams as $team)
        {
            $members = [];

            // fetch players
            $bowlers = \App\Player::whereNotIn('id', $pickedPlayerIds)
                                    ->where('type', 'bowler')
                                    ->take(4)
                                    ->get()
                                    ->toArray();

            $allRounders = \App\Player::whereNotIn('id', $pickedPlayerIds)
                                    ->where('type', 'all-rounder')
                                    ->take(3)
                                    ->get()
                                    ->toArray();


            $batsmen = \App\Player::whereNotIn('id', $pickedPlayerIds)
                                    ->where('type', 'batsman')
                                    ->take(5)
                                    ->get()
                                    ->toArray();
            $members = array_merge($bowlers, $batsmen, $allRounders);

            // we need to remove all the players of a team before we work with it
            \App\TeamMember::where('team_id', $team->id)->delete();

            foreach ($members as $key => $member) {
                // this prevents any duplicates
                $pickedPlayerIds[] = $member['id'];

                $teamMember = new \App\TeamMember();
                $teamMember->team_id = $team->id;
                $teamMember->player_id = $member['id'];
                $teamMember->substitute = ($key == 11); // last player
                $teamMember->save();
            }
        }
    }
}
