<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    public const TELECENTRO_TECNICA = 1;
    public const CONTACTCOM_TECNICA = 2;
    public const KONECTA_TECNICA = 3;
    public const ATENTO_TECNICA = 4;
    protected $sector;

    public function user()
    {
        return $this->hasMany('App\User');
    }

    public function setTlcTenica() 
    {
        return $this->sector = SECTOR::TELECENTRO_TECNICA;
    }

    public function setContactComTecnica() 
    {
        return $this->sector = SECTOR::CONTACTCOM_TECNICA;
    }

    public function setKonectaTecnica() 
    {
        return $this->sector = SECTOR::KONECTA_TECNICA;
    }

    public function setAtentoTenica() 
    {
        return $this->sector = SECTOR::ATENTO_TECNICA;
    }
}
