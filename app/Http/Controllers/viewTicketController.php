<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;

class viewTicketController extends Controller
{
    public function index()
    {

     $tickets = Ticket::all();
	 return view('viewTicket')->with('tickets',$tickets);
    }
}
