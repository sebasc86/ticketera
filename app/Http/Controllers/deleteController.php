<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use App\User;
use App\Comment;


class deleteController extends Controller
{
    public function index()
    {       
        Ticket::find(11)->delete();
        $tickets = Ticket::get();
        

        return view('delete')->with('tickets', $tickets);
    }

}
