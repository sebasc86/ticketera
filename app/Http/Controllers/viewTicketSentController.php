<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ticket;
use App\User;

class viewTicketSentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {

    	$user = Auth::user();
		$userId = $user->id;	
		$userFind = User::find($userId);
		$tickets= $userFind->tickets;

		

		
		return view('viewTicketSent')->with('tickets',$tickets);


    }
}
