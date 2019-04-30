<?php

namespace App\Transformers;
use App\Team;
use League\Fractal\TransformerAbstract;

/**
 * Class TeamTransformer
 * Transforms given data for a team by including members
 * @package App\Transformers
 */
class TeamTransformer extends TransformerAbstract
{
    public function transform(Team $team)
    {
        $players = [];

        foreach ($team->members as $member)
        {
            $member->player->substitute = $member->substitute ?? 0;
            $players[] = $member->player;
        }

        return [
            "id"    =>  $team->id,
            'name'  =>  $team->name,
            'icon'  =>  $team->icon,
            'players'   =>  $players
        ];
    }
}