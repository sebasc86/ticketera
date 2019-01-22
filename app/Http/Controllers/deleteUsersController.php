<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Ticket;
use App\User;
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
            $user->delete();
    

        return response()->json(['success'=>'1']);
    }
}
