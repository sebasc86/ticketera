<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ticket;
use App\User;
use App\Comment;


class deleteController extends Controller
{
    public function index(Request $request)
    {      

        $user = Auth::user();
        if($user->isAdmin === 1) {
            $ticket = $request->ticket;
            $ticketN = Ticket::where('number', $ticket)->first()->delete();
        }

        return response()->json(['success'=>'1']);
    }

}
