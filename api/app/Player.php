<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    const TYPES = [
        "bowler",
        "batsman",
        "all-rounder",
        "wicket-keeper"
    ];

    protected $fillable = [
        "name", "country", "type"
    ];

    public function memberOf()
    {
        return $this->belongsTo('App\TeamMember');
    }
}
