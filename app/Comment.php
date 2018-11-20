<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

	//falta clave foranea en ticket para relacionar con Comment
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function file()
    {
        return $this->hasMany('App\File');
    }

    
}
