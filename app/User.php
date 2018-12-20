<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    use SoftCascadeTrait;

    protected $dates = ['deleted_at'];

    protected $softCascade = ['tickets'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'sector_id', 'isAdmin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function ticket()
    {
        return $this->hasMany('App\Ticket');
    }

    public function comment()
    {
        return $this->hasMany('App\Comment');
    }

    public function sector()
    {
        return $this->belongsTo('App\Sector');
    }

}
