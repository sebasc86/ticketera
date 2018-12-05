<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Ticket;
use App\User;

class getTicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {


        $user = Auth::user();
        $userId = $user->id;

        $ticketsQueue= Ticket::where('queue', $userId)->get();
        
        $ticketsOpen = $ticketsQueue->filter(function($item, $key){

            return $item->status === 1;
            
        });
        
        $ticketsOpen->all();

		return view('get')->with('ticketsOpen', $ticketsOpen);

    }


    public function getTickets()
    {   
        
        $user = Auth::user();
        $userId = $user->id;

        $ticketsQueue= Ticket::where('queue', $userId)->get();  

        //lo paso a array para saber si esta vacio o no
        if( !$ticketsQueue->isEmpty() ) {
            
            $userTid = $ticketsQueue->first()->user_id;
            $user = $user::find($userTid);

            foreach ($ticketsQueue as $key => $value) {
                $value->user_id = $user->name;
                if($value->status === 0){
                    $value->status = 'Cerrado';
                } else {
                    $value->status = 'Abierto';
                };
            }

            return Datatables::of($ticketsQueue)->make(true);

        } else {

            return Datatables::of($ticketsQueue)->make(false);
            
        }    

    }
}
