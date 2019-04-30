<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    protected $fillable = [
        "round_id", "team_id", "opponent_id", "finished"
    ];

    public function round()
    {
        return $this->belongsTo('App\Round');
    }

    public function team()
    {
        return $this->hasOne('App\Team', 'id', 'team_id');
    }

    public function opponent()
    {
        return $this->hasOne('App\Team', 'id', 'opponent_id');
    }

    public function data()
    {
        return $this->hasMany('App\MatchDatum', 'match_id', 'id');
    }

}
