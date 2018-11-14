<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

	//falta clave foranea en ticket para relacionar con Comment
/*    public function tickets()
    {
        return $this->belongsTo('App\Ticket');
    }*/
}
