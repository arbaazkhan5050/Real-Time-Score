<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TeamMember
 *
 * We are decoupling some tables to make sure we can later modify them dynamically.
 * @package App
 */
class TeamMember extends Model
{
    protected $table = "team_members";

    protected $fillable = [
        "team_id", "player_id",
    ];

    public function team()
    {
        return $this->belongsTo('App\Team');
    }

    public function player()
    {
        return $this->belongsTo('App\Player');
    }
}
