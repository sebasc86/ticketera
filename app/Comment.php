<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function ticket()
    {
        return $this->hasOne('App\Ticket');
    }
}
