<?php

namespace App\Transformers;
use App\Player;
use League\Fractal\TransformerAbstract;

/**
 * Class TeamTransformer
 * Transforms given data for a team by including members
 * @package App\Transformers
 */
class PlayerTransformer extends TransformerAbstract
{
    public function transform(Player $player)
    {
        return [
            'name'      =>  $player->name,
            'country'   =>  $player->country,
            'type'      =>  $player->type,
            'team'      =>  $player->member_of !== null ? $player->memberOf()->team : null
        ];
    }
}