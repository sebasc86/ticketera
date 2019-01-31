<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ticket;
use App\User;
use App\Sector;
use App\Comment;

class deleteUsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin'); 
    }

    public function delete(Request $request)
    {      


            $userId = $request->id;
            $user = User::find($userId);
            
            if($user->sector->user_id === $user->id){
                $sector = Sector::find($user->id);
                
                $ticketsQueue = Ticket::where('queue', $sector->user_id)->get();
                    $ticketsQueue->map(function($ticketQueue){
                    $ticketQueue->delete();
                });

                $sector->delete();
                return response()->json(['success'=>'1']);
            }

            $ticketsQueue = Ticket::where('queue', $user->id)->get();
            
            $ticketsQueue->map(function($ticketQueue){
                $ticketQueue->delete();
            });

            $user->delete();

        return response()->json(['success'=>'1']);
    }
}
