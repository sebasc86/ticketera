<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Ticket;
use App\User;

class sentTicketController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    
    public function index()
    {   

        $user = Auth::user();
        $userId = $user->id;    

        $tickets = $user->ticket;
        
        $ticketsOpen = $tickets->filter(function($item, $key){

            return $item->status === 1;
            
        });

		return view('sent')->with('ticketsOpen', $ticketsOpen);

    }

    public function getTickets()
    {   
        
        $user = Auth::user();
        $userId = $user->id;
        $tickets = $user->ticket;
       
        
        foreach ($tickets as $key => $value) {

            $userQueue = $value->queue;
            
            $userGet = User::find($userQueue);

            // return response()->json(['success'=>$userGet]);
            if($userGet == null) {
                $ticket = Ticket::find($value->id)->delete();
            } 
        
            $value->queue = $userGet->name;
            $value->sector =  $userGet->sector->name;


            if($value->status === 0){
                $value->status = 'Cerrado';
            } else {
                $value->status = 'Abierto';
            };
        }
       
        return Datatables::of($tickets)->make(true);        

    }
}
