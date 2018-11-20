<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Ticket;
use App\User;

class viewTicketGetController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {

    	// $user = Auth::user();
		// $userId = $user->id;	
		// $userFind = User::find($userId);
		// $userN = $userFind->id;
		

		// $userQueue = Ticket::where('queue', $userN)->get();

		
		return view('viewTicketGet');


    }


    public function getTickets()
    {   
        
        $user = Auth::user();
        $userId = $user->id;

        $ticketsQueue= Ticket::where('queue', $userId)->get();  
        $userTid = $ticketsQueue->first()->user_id;
        $user = $user::find($userTid);
    
        foreach ($ticketsQueue as $key => $value) {
            $value->user_id = $user->name;
        }   
            
        return Datatables::of($ticketsQueue)->make(true);        

    }
}
