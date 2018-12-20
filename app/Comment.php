<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Comment extends Model
{

    use SoftDeletes;
    use SoftCascadeTrait;


    protected $dates = ['deleted_at'];

    protected $softCascade = ['file'];

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
        return $this->hasMany(File::class);
    }

    
}
