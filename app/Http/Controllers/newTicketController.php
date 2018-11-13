<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ticket;
use Illuminate\Support\Facades\Auth;

class newTicketController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index()
    {
		return view('newTicket');

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
		  'email' => 'required|email',
		]);


		$tickets =  Ticket::all()->last();
		if($tickets) {
			$ticketLastId = $tickets->id;
		} else {
			$ticketLastId = 0;
		}


		$ticket = new Ticket;

		$ticket->status = 1;
		$ticket->apartament  = 'chessecake';
	    $ticket->client = request()->clientN;
	    $ticket->description = request()->description;
	    $ticket->details = request()->details;
	    $ticket->user_id = $userId;
		$ticket->number = date('Ymd') . 0 . $ticketLastId + 1;
		$ticket->save();
		
          
       /*$user->document = request()->document;
	    $user->phone = request()->phone;
	    $user->update();
	   	Car::create([
	    	'user_id' => Auth::user()->id,
	    	'trademark' => request('trademark'),
	    	'model' => request('model'),
	    	'year' => request('year'),
	    	'color' => request('color'),
	    	'license_plate' => request('license_plate'),
	    	'capacity' => request('capacity'),
	    ]);    */


          
        
        return redirect('newTicket');   


          
    }
}
