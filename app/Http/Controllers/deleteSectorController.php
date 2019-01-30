<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sector;
use App\User;
use App\Comment;
use App\Ticket;

class deleteSectorController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin'); 
    }

    public function delete(Request $request)
    {      
            $sectorId = $request->id;
            $sector = Sector::find($sectorId);
            $ticketsQueue = Ticket::where('queue', $sector->user_id)->get();
            $ticketsQueue->map(function($ticketQueue){
                $ticketQueue->delete();
            });
            
            $sector->delete();
    

        return response()->json(['success'=>'1']);
    }
}
