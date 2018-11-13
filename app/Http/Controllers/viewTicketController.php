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

		

		$userQueue = Ticket::where('queue', $userId)->first();
		$ticketN = Ticket::where('number', $ticket)->first();

		

		$ticketQueue = $ticketN->queue;
		$ticketUser = $ticketN->user_id;
		

		$userFind = User::find($ticketUser);
		


				
		if($ticketUser == $userId || $userId == $ticketQueue){
		 	return view('ticketView')->with('ticketNumber', $ticketN)->with('userFind', $userFind);
		}else {
			$problem = 'Acceso restringido';
			return view('ticketView')->with('problem', $problem);
		};
		
		

    }
}
