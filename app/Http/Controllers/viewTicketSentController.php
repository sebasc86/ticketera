<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Ticket;
use App\User;

class viewTicketSentController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('viewTicketSent');
    }

    public function getTickets()
    {   
        $user = Auth::user();
        $userId = $user->id;
        $userFind = User::find($userId);
        $tickets = $userFind->ticket;
        return Datatables::of($tickets)->make(true);
        // $tickets = Ticket::select(['id','number','user_id','status']);
        // return Datatables::of($tickets)->make(true);
        

    }
}
