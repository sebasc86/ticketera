<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Ticket;
use App\User;
use App\Comment;
use App\File;

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
			$ticketNumber = $ticketN->number;
			$ticketName = $ticketN->user->name;
			
			$request->session()->put('ticket_id', $ticketId);
			$ticketQueue = $ticketN->queue;
			$ticketUserId = $ticketN->user_id;
			$files = File::where('ticket_id', $ticketId)->get()->all();
			

			// SI ESTAN BIEN ECHAS LAS TABLAS DE REALIACIONES NO HACE FALTA ESTO
			// $comments = DB::table('tickets')
			// ->where('number', $ticket)
			// ->join('comments', 'tickets.id', '=', 'comments.ticket_id')
			// ->join('users', 'users.id', '=' ,'comments.user_id')
			// ->get();

			// $userNameComments = [];
			// $i = 0;
			// foreach ($comments as $value) {
			// 	$userNameComments = User::where('id', $value->user_id)->first()->name;
			// 	$i++;
			// }

			// $comments = $ticketN->comment;
			// $comments2 = $comments->where('user_id', $ticketN->user->id);
			
			// $userCommentId($comments2->first()->user_id)
			// foreach ($comments2 as $key => $value) {
				
			// }

			
			

			//queue es la cola de usuario osea esta realacionado al id del usuario	
			if($ticketUserId == $userId || $userId == $ticketQueue){
		 		return view('/ticketView')->with('ticket', $ticketN)->with('userLoginId', $userId)->with('files', $files);
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
			$userName = $user->name;
			

			$ticketId = $request->session()->get('ticket_id');

					

	        $comment = new Comment();
	        $comment->user_id = $userId;
	        $comment->comments = $request->comments;
	        $comment->ticket_id = $ticketId;        

	        $comment->save();
	        

	        return response()->json(['success'=>'1','userName' => $userName]);
	 }

	 public function close(Request $request)
	 {		
			 
			$ticketId = $request->session()->get('ticket_id');
			$ticket = Ticket::find($ticketId);
			$ticket->status = 0;
			$ticket->save();
			
			

			return response()->json(['success'=>'0','ticketId' => $ticketId]);

	 }
}
