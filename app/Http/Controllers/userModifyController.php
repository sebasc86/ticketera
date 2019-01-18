<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Ticket;
use App\User;
use App\Sector;


class userModifyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin'); 
    }

    public function index(Request $request)
    {   
        return view('userModify');
    }
}
