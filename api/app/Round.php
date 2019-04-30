<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Round extends Model
{
    protected $fillable = ["name"];

    public function matches()
    {
        return $this->hasMany('App\Match');
    }

}
