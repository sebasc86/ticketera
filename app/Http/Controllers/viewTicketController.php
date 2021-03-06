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
use App\Sector;
use App\Mail\TicketCloseMail;
use App\Jobs\SendEmailJobClose;

class viewTicketController extends Controller
{

	public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $ticket)
    {

    	$user = Auth::user();
			$userId = $user->id;



			$userQueue = Ticket::where('queue', $userId)->first();
			$ticketN = Ticket::where('number', $ticket)->first();

			if($ticketN == null) {
			 	return abort(403, "Ticket eliminado con anterioridad");
			}

			$sector = Sector::find($ticketN->sector);


		if($ticketN) {



			$ticketId = $ticketN->id;
			$ticketNumber = $ticketN->number;

			if($ticketN->user){
				$ticketName = $ticketN->user->name;

			}else {
				//por si el usuario creador esta borrado muestre el ticket
				$userDelete = User::withTrashed()->find($ticketN->user_id);
				$ticketName = $userDelete->name;
				$ticketN->user = $userDelete;
			}



			//sector - usuario y ticket que esperar recibir el ticket
			$userQueueName = User::find($ticketN->queue);


			if($userQueueName == null) {
				$sectorDelete = New Sector;
				$sectorDelete->name = 'Usuario inexistente o borrado';
				$sectorQueue = $sectorDelete;
				$userDelete = new User;
				$userDelete->name = 'Usuario inexistente o borrado';
				$userQueueName = $userDelete;
				$ticket = Ticket::find($ticketN->id)->delete();
				return redirect('/');
			} else {
				$sectorQueue = Sector::find($userQueueName->sector_id);
			}


			$ticketQueue = $ticketN->queue;

			//recupero inserto el ticket en sesion
			$request->session()->put('ticket_id', $ticketId);

			//Usuario creador del ticket
			$ticketUserId = $ticketN->user_id;
			//busco los files subidos vinculados a ese ticket
			$files = File::where('ticket_id', $ticketId)->get()->all();

			// Busco Sector que es propietario de ese ticket. //Sector no contiene el nombre solo el id del sector.
			$ticketSector =  Sector::find($ticketN->queue);
			if(isset($ticketSector)){
							$sectorIdQueue = $ticketSector->id;


							$sectorName = $ticketSector->name;

							//renombro el ticket sector que es un numero al nombre asi se lo paso a la vista.
							$ticketN->sector = $sectorName;
			}


			if($ticketUserId == $userId || $userId == $ticketQueue || $user->sector_id == $sectorIdQueue || $user->sector->id == Sector::TELECENTRO_TECNICA){
		 		return view('/view')
		 		->with('ticket', $ticketN)
		 		->with('userLoginId', $userId)
		 		->with('files', $files)
		 		->with('userSent', $userQueueName)
		 		->with('sectorQueue', $sectorQueue);

			}else {
				return abort(403, "Usted no tiene permiso para ver este ticket");
			};

		}else {
			return abort(403, "Usted no tiene permiso para ver este ticket");
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

                for ($x = 0; $x < $request->TotalFiles; $x++) {

					if ($request->hasFile('imgfiles'.$x)) {

                        $file = $request->file('imgfiles'.$x);
                        $fileSize = $file->getSize();
                        if($fileSize > 10485760 ) {
                            return response()->json(['errorSize'=> '1' ]);
                        }
					}

				}

				$comment = new Comment();
				$comment->user_id = $userId;
				$comment->comments = $request->commentsNode;
				$comment->ticket_id = $ticketId;

				$comment->save();
				$ticketNumber = $comment->ticket->number;
				$commentId = $comment->id;


				for ($x = 0; $x < $request->TotalFiles; $x++) {

					if ($request->hasFile('imgfiles'.$x)) {

                        $file      = $request->file('imgfiles'.$x);
                        $fileSize = $file->getSize();
						$filename  = $file->getClientOriginalName();
						$extension = $file->getClientOriginalExtension();
						$files     = uniqid() . "." .$extension;
						$filesArray[] = $files;
						//Save files in below folder path, that will make in public folder
						$file->move(storage_path('app/public/uploads/files'), $files);



						$newFileDb = new File;
						$newFileDb->comment_id = $commentId;
						$newFileDb->filename = $files;
						$newFileDb->save();

					}

				}

				return response()->json(['errorSize' => '0', 'success'=>'1','userName' =>  $userName, 'filename' => $filesArray, 'ticketNumber' => $ticketNumber]);

			} else if (isset($request->commentsNode))	{
				$comment = new Comment();
				$comment->user_id = $userId;
				$comment->comments = $request->commentsNode;
				$comment->ticket_id = $ticketId;

				$comment->save();

				return response()->json(['errorSize' => '0', 'success'=>'1','userName' =>  $userName, 'filename' => "null", 'ticketNumber' => "null"]);

			}


	}

	public function close(Request $request)
	{


		$ticketRequest = $request->ticketNumber;
		// $ticketId = $request->session()->get('ticket_id');

		$ticketFind= Ticket::where('number', $ticketRequest)->first();
		$ticketId = $ticketFind->id;

		$ticket = Ticket::find($ticketId);
		$ticket->status = 0;
		$ticket->close_user_id = Auth::user()->id;


		$comment = new Comment();
		$comment->user_id = Auth::user()->id;
		$comment->comments = $request->message;
		$comment->ticket_id = $ticketId;

		$comment->save();
		$ticket->save();


		return response()->json(['success'=>'0','ticketId' => $ticketId]);

	}

	public function sendEmail(Request $request)
	{
		$ticketId = $request->session()->get('ticket_id');
		$ticket = Ticket::find($ticketId);
		$user = User::find($ticket->user_id);
		$userAuth = Auth::user();


		if($user != null) {
			dispatch(new SendEmailJobClose($user, $ticket, $userAuth))
			->onConnection('database');
		} else {
			$user = User::withTrashed()->find($ticket->user_id);
			dispatch(new SendEmailJobClose($user, $ticket, $userAuth))
			->onConnection('database');
		}

	}

	public function download(Request $request, $ticket, $filename)
	{
		return response()->download(storage_path("app/public/uploads/files/{$filename}"));
	// return Storage::download ("public/uploads/files/$filename");
	}
}
