<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ticket;
use App\File;
use Illuminate\Support\Facades\Auth;

class newTicketController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index()
    {

    	$userLogin = Auth::user();
    	$users =  User::all();
    	$usersArray;
    	foreach ($users as $value) {
    		if($value->id != $userLogin->id){
    			$usersArray[] = $value;
    		};
    	};

		return view('/newTicket')->with('userLogin', $userLogin)->with('usersAll', $usersArray);

    }

    public function store()
    {

		$user = Auth::user();
		$userId = $user->id;	
        
		$this->validate(request(), [       
		/*          'name' => 'required|numeric',
		  'email' => 'unique:users,email,'.$user->id,
		  'password' => 'required|alpha_num|min:8|max:12',
		  'password_confirmation' => 'required|same:password',
		  'accion' => 'required|array',
		  'accion.driver' =>  'min:1|max:1',
		  'accion.co-driver' =>  'min:2|max:2',
		  'profile_picture' => 'max:2048|mimes:jpg,jpeg,gif,png',*/
		  /*'email' => 'required|email',*/
		]);


		$tickets =  Ticket::all()->last();
		if($tickets) {
			$ticketLastId = $tickets->id;
		} else {
			$ticketLastId = 0;
		}


		$ticket = new Ticket;

		$ticket->status = 1;
		$ticket->sector  = 'chessecake';
		$ticket->queue = request()->queue;
	    $ticket->client = request()->clientN;
	    $ticket->title = request()->title;
	    $ticket->details = request()->details;
	    $ticket->user_id = $userId;
		$ticket->number = date('Ymd') . 0 . $ticketLastId + 1;
		$ticket->save();          
		
		
		
		if(request()->file != null) {

			
						foreach (request()->file as $key => $value) {
							// Asignamos nombre para la DB	
							$fileName = uniqid() . "." . $value->extension(); 
							// Defino la carpeta en la que voy a guardar la imagen
							$folder =  'uploads/files';
							// Almacenar la imagen en el servidor con el nuevo nombre
							$path =  $value->storeAs($folder, $fileName, 'public');
							// Salvamos el usuario para la data base.
							
							$file = new File;
							$file->ticket_id = $ticket->id;
							$file->filename = $fileName;
							$file->save();
						}
			
						
			// php artisan storage:link -> link storage desde consola.       
					}
        return redirect('newTicket');   


          
    }
}
