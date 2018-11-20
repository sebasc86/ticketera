<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function comment()
    {
    	return $this->hasMany('App\Comment', 'ticket_id', 'id');
    }

    public function file()
    {
        return $this->hasMany('App\File');
    }



}
