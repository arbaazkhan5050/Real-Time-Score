<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MatchDatum extends Model
{
    protected $fillable = [
        "match_id", "event", "batsman_id", "bowlder_id", "outcome"
    ];
}
