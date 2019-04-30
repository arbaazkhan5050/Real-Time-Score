<?php

namespace App\Http\Controllers;

use App\Match;
use App\Round;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class Rounds
 * @group Rounds
 * @package App\Http\Controllers
 */
class Rounds extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a new Round
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'teams' =>  'required'
        ];

        $this->validate($request, $rules);

        // For now, we're only going to use just one round.
        // So we need to delete all the others to reduce DB clutter

        DB::table('rounds')->delete();

        // save the new round
        $round = Round::create([
            'name'  =>  'Round 1'
        ]);

        // this will hold the matches
        $matches = [];

        $teams = $request->get('teams');

        $number_of_matches = \round(count($teams) / 2);

        for ($i = 0; $i < $number_of_matches; $i++) {
            // randomly pick two teams
            $team_keys = array_rand($teams, 2);

            $team_id = $teams[$team_keys[0]];
            $opponent_id = $teams[$team_keys[1]];

            $match = new Match();
            $match->round_id = $round->id;
            $match->team_id = $team_id;
            $match->opponent_id = $opponent_id;
            $match->finished = 0;
            $match->save();

            $matches[] = $match;

            // remove them from the array to prevent duplicates
            unset($teams[$team_keys[0]], $teams[$team_keys[1]]);

        }

        return $this->response->array([
            'round_id'  =>  $round->id,
            'matches'   => $matches,
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
