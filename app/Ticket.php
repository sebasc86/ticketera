<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    public function users()
    {
        return $this->belongsTo('App\User');
    }

}
