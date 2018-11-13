<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ticket;
use App\User;

class viewTicketController extends Controller
{


    public function index(Request $request,$ticket)
    {

    	$user = Auth::user();
		$userId = $user->id;	
		$userFind = User::find($userId);
		$userN = $userFind->id;
		

		$userQueue = Ticket::where('queue', $userN)->get(;
		$ticketN = Ticket::where('number', $ticket)->get();

		dd($userQueue);
		
		
		return view('ticketView');

    }
}
