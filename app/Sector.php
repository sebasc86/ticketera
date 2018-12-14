<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{		

		public const TELECENTRO_TECNICA = 1;
		public const ATENTO_TECNICA = 2;
    public const CONTACTOM_TECNICA = 3;
    public const KONECTA_TENICA = 4;
    protected $sector;

    public function user()
    {
        return $this->hasMany('App\User');
    }

}
