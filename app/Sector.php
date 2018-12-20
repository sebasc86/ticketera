<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class Sector extends Model
{		

    use SoftDeletes;
    use SoftCascadeTrait;


    protected $dates = ['deleted_at'];

    protected $softCascade = ['user'];

    protected $sector;

	public const TELECENTRO_TECNICA = 1;
	public const ATENTO_TECNICA = 2;
    public const CONTACTOM_TECNICA = 3;
    public const KONECTA_TECNICA = 4;
    

    public function user()
    {
        return $this->hasMany('App\User');
    }

}
