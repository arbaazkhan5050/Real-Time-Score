<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * We're going to use Font-Awesome icons as team icons for speed
     * In a real world application, this would be options to choose from
     * and we would allow the editors/admins to upload logos
     */
    const TEAM_ICONS = [
        "cat",
        "horse",
        "crow",
        "dog",
        "dove",
        "dragon",
        "feather",
        "feather-alt",
        "fish",
        "frog",
        "hippo",
        "horse",
        "horse-head",
        "kiwi-bird",
        "otter",
        "paw",
        "spider"
    ];

    protected $fillable = [
        "name", "icon"
    ];

    public function members()
    {
        return $this->hasMany('App\TeamMember')->with('player');
    }
}
