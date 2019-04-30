<?php

namespace App\Events;

class MatchDataCheck extends Event
{

    public $matches;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($matches)
    {
        $this->matches = $matches;
    }
}
