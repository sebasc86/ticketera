<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class File extends Model
{

    use SoftDeletes;
    use SoftCascadeTrait;

    protected $dates = ['deleted_at'];
    
	public function ticket()
    {
        return $this->belongsTo('App\Ticket');
    }

    public function comment()
    {
        return $this->belongsTo('App\Comment');
    }

}
