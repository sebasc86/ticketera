<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
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
			

			$ticketId = $ticketN->id;

			$request->session()->put('ticket_id', $ticketId);
			$ticketQueue = $ticketN->queue;
			$ticketUser = $ticketN->user_id;

			$comments = DB::table('comments')
			->join('tickets', 'tickets.id', '=', 'comments.ticket_id')
			->get();

			$userIdComments = [];
			$i = 0;
			foreach ($comments as $value) {
				$userIdComments[] = $value->user_id;
				$create = $value->created_at;
				$id = $value->id;
				$i++;
			}

			dd($userIdComments);
			
			

			$ticketUserCreator = User::find($ticketUser);
			


				
			if($ticketUser == $userId || $userId == $ticketQueue){
		 		return view('/ticketView')->with('ticketNumber', $ticketN)->with('ticketUserCreator', $ticketUserCreator)->with('comments', $comments);
			}else {
				return abort(403);
			};
		}else {
			return abort(403);
		}
		
		
		

    }

     public function store(Request $request)
	 {		

	 		$user = Auth::user();
			$userId = $user->id;

			$ticketId = $request->session()->get('ticket_id');

					

	        $comment = new Comment();
	        $comment->user_id = $userId;
	        $comment->comments = $request->comments;
	        $comment->ticket_id = $ticketId;        

	        $comment->save();
	        

	        return response()->json(['success'=>'ok']);
	 }
}
