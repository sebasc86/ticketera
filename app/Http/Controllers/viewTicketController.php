<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
			
			/*dd(Storage::response("public/uploads/files/$files->filename"));*/
			// $contents = Storage::disk('public')->get('uploads/files/'.$files->filename);
			// dd($contents);
			//queue es la cola de usuario osea esta realacionado al id del usuario	

			if($ticketUserId == $userId || $userId == $ticketQueue){
		 		return view('/view')->with('ticket', $ticketN)->with('userLoginId', $userId)->with('files', $files);
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

	 public function download(Request $request, $ticket, $filename) 
	 {	
		return Storage::download ("public/uploads/files/$filename");
	 }
}
