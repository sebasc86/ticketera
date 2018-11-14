<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ticket;
use App\User;
use App\Comment;

class viewTicketController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request,$ticket)
    {

    	$user = Auth::user();
		$userId = $user->id;

		

		$userQueue = Ticket::where('queue', $userId)->first();
		$ticketN = Ticket::where('number', $ticket)->first();

		
		if($ticketN) {
			$ticketQueue = $ticketN->queue;
			$ticketUser = $ticketN->user_id;
		

			$userFind = User::find($ticketUser);
			


				
			if($ticketUser == $userId || $userId == $ticketQueue){
		 		return view('/ticketView')->with('ticketNumber', $ticketN)->with('userFind', $userFind);
			}else {
				return abort(403);
			};
		}else {
			return abort(403);
		}
		
		
		

    }

     public function store(Request $request)
	 {		
	        $comment = new Comment();
	        $comment->comments = $request->comments;


	        $comment->save();

	        return response()->json(['success'=>'Data is successfully added']);
	 }
}
