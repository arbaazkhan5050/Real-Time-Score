<?php

namespace App\Listeners;

use App\Events\ExampleEvent;
use App\Events\MatchDataCheck;
use App\MatchDatum;
use App\Player;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Carbon\Carbon;

class CalculateMatchData
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ExampleEvent  $event
     * @return void
     */
    public function handle(MatchDataCheck $event)
    {
        $matches = $event->matches;
        // make an action happen
        // each 5s past is a ball
        // each 5s past = 1m in-game

        foreach ($matches as $match)
        {
            $started_at = Carbon::parse($match->created_at);
            $elapsed_since_match_start = $started_at->diffInMinutes(Carbon::now());

            $last_updated = MatchDatum::where('match_id')->orderBy('updated_at','DESC')->first();

            if($last_updated)
            {
                $last_updated_at = Carbon::parse($last_updated->updated_at);
            }

            $elapsed_since_last_update = !$last_updated ? null : $last_updated_at->diffInMinutes(Carbon::now());

            $total_elapsed_time = is_null($elapsed_since_last_update) ? $elapsed_since_match_start : $elapsed_since_last_update;

            $total_balls = floor($total_elapsed_time / 5);
            $total_overs = round($total_balls / 6, 2);

            $match->total_balls = $total_balls;
            $match->total_overs = $total_overs;

            $last_bowler = $last_updated ? Player::find($last_updated->bowler_id) : null;

            if(! $last_bowler )
            {
//                $last_bowler = Team::randomPlayer('bowler', $match->)
            }

//            echo $total_overs . PHP_EOL;


        }
//        die();
    }
}
