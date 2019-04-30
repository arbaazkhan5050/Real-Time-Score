<?php

namespace App\Transformers;
use App\Match;
use App\Team;
use App\TeamMember;
use League\Fractal\TransformerAbstract;

/**
 * Class TeamTransformer
 * Transforms given data for a team by including members
 * @package App\Transformers
 */
class MatchTransformer extends TransformerAbstract
{
    public function transform(Match $match)
    {



        return [
            'round'     =>  $match->round,
            'team'      =>  $match->team,
            'team_players'  =>  $match->team->members,
            "opponent"  =>  $match->opponent,
            "opponent_players"  =>  $match->opponent->members,
            "data"      =>  $match->data,
            'finished'  =>  $match->finished,
            "started_at"    =>  $match->created_at,
            'finished_at'   =>  !$match->finished ? null : $match->updated_at

        ];
    }
}