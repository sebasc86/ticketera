<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Ticket;
use App\User;
use App\Comment;
use App\File;
use App\Mail\TicketCloseMail;

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
		
		dd($ticketN->comment);
		
		if($ticketN) {
			

			$ticketId = $ticketN->id;
			$ticketNumber = $ticketN->number;
			$ticketName = $ticketN->user->name;
			$userQueueName = USER::find($ticketN->queue);
			
			$request->session()->put('ticket_id', $ticketId);
			$ticketQueue = $ticketN->queue;
			$ticketUserId = $ticketN->user_id;
			$files = File::where('ticket_id', $ticketId)->get()->all();
			/*$filesComments = File::where('comment_id', )*/
			
			/*dd(Storage::response("public/uploads/files/$files->filename"));*/
			// $contents = Storage::disk('public')->get('uploads/files/'.$files->filename);
			// dd($contents);
			//queue es la cola de usuario osea esta realacionado al id del usuario	

			if($ticketUserId == $userId || $userId == $ticketQueue){
		 		return view('/view')->with('ticket', $ticketN)->with('userLoginId', $userId)->with('files', $files)->with('userSent', $userQueueName);
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






			if($request->TotalFiles > 0 && isset($request->commentsNode))
			{
				//Loop for getting files with index like image0, image1

				$comment = new Comment();
		        $comment->user_id = $userId;
		        $comment->comments = $request->commentsNode;
		        $comment->ticket_id = $ticketId;        

		        $comment->save();

		        $commentId = $comment->id;



				for ($x = 0; $x < $request->TotalFiles; $x++) {

					if ($request->hasFile('imgfiles'.$x)) {

						$file      = $request->file('imgfiles'.$x);
						$filename  = $file->getClientOriginalName();
						$extension = $file->getClientOriginalExtension();
						$files   = uniqid() . "." .$extension;

						//Save files in below folder path, that will make in public folder
						$file->move(storage_path('app/public/uploads/files'), $files);



						$newFileDb = new File;
						$newFileDb->comment_id = $commentId;
						$newFileDb->filename = $files;
						$newFileDb->save();

					}

				}

		        return response()->json(['success'=>'1','userName' => $comment->id]);

			} else if (isset($request->commentsNode))	{
				$comment = new Comment();
		        $comment->user_id = $userId;
		        $comment->comments = $request->commentsNode;
		        $comment->ticket_id = $ticketId;        

		        $comment->save();

			}


	 }

	 public function close(Request $request)
	 {		
			 
			$ticketId = $request->session()->get('ticket_id');
			$ticket = Ticket::find($ticketId);
			$ticket->status = 0;
			$ticket->save();


			return response()->json(['success'=>'0','ticketId' => $ticketId]);

	 }

	 public function sendEmail(Request $request)
	 {		
			$ticketId = $request->session()->get('ticket_id');
			$ticket = Ticket::find($ticketId);
			$user = User::find($ticket->user_id);
			$userQueue = User::find($ticket->queue);

			Mail::to($user->email)
			->cc($userQueue->email)
			->send(new TicketCloseMail($user, $ticket, $userQueue));

	 }

	 public function download(Request $request, $ticket, $filename) 
	 {	
		return Storage::download ("public/uploads/files/$filename");
	 }
}
