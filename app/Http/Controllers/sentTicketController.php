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
    }

    
    public function index()
    {
         return view('sent');
    }

    public function getTickets()
    {   
        
        $user = Auth::user();
        $userId = $user->id;
        $userFind = User::find($userId); 
        $tickets = $userFind->ticket;
        
        foreach ($tickets as $key => $value) {
            $userQueue = User::find($value->queue);
            $value->queue = $userQueue->name;
            if($value->status === 0){
                $value->status = 'Cerrado';
            } else {
                $value->status = 'Abierto';
            };
        }
       
        return Datatables::of($tickets)->make(true);        

    }
}
