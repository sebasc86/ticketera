<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    public const CLOSE_STATUS = 0;
    public const OPEN_STATUS = 1;
    public const IN_PROGRESS_STATUS = 2;
    protected $user_id;
    protected $status;
    protected $number;
    protected $sector;

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

    public function setOpenStatus() 
    {
        return $this->status = TICKET::OPEN_STATUS;
    }

    public function setCloseStatus() 
    {
        return $this->status = TICKET::CLOSE_STATUS;
    }

    public function setInProgress() 
    {
        return $this->status = TICKET::IN_PROGRESS_STATUS;
    }


    public function setUser($userId) 
    {
        return $this->user_id = $userId;
    }

    public function setSectorId($sector) 
    {
        return $this->sector = $sector;
    }

    public function setTicketNumber()
    {
        $date = date('Ymd');
        return $this->number = $date . 0 . $this->ticketLast() + 1;
    }


    public function user()
    {
        return $this->belongsTo('App\User');
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
