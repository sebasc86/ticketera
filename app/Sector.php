<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{

    protected $sector;

    public function user()
    {
        return $this->hasMany('App\User');
    }

}
