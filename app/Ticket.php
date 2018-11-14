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
//falta clave foranea para relacionar con ticket
/*    public function comments()
    {
    	return $this->hasMany('App\Comment', 'ticket_id', 'id');
    }*/

}
