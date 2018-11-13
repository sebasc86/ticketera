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
		

		$userQueue = Ticket::where('queue', $userN)->first();
		$ticketN = Ticket::where('number', $ticket)->first();


		$ticketQueue = $ticketN->queue;
		$ticketUser = $ticketN->user_id;

		
		
		if($ticketUser == $userN || $userN == $ticketQueue){
		 	return view('ticketView')->with('ticketNumber', $ticketN);
		}else {
			$problem = 'Acceso restringido';
			return view('ticketView')->with('problem', $problem);
		};
		
		

    }
}
