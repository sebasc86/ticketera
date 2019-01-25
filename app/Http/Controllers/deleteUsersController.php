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
                $sector->delete();
                return response()->json(['success'=>'1']);
            }
            $user->delete();
    

        return response()->json(['success'=>'1']);
    }
}
