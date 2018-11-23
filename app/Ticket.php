<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    public const CLOSE_STATUS = 0;
    public const OPEN_STATUS = 1;
    public const IN_PROGRESS_STATUS = 2;
    protected $user;

    // Constructor
    public function __construct(){
        
    }

    public function ticketLast()
    {
        $tickets =  Ticket::all()->last();
		if($tickets) {
			return $ticketLastId = $tickets->id;
		} else {
			return $ticketLastId = 0;
		}
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function setUser($userId) 
    {
        $this->user_id = $userId;
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
