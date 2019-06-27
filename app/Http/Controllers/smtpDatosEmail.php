<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Ticket;
use App\User;
use App\Sector;



class smtpDatosEmail extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('sectorAdmin');
    }

    public function index()
    {
			$emailEnv =	readEmailinEnv();
			$emailEnv =	readPassEmailinEnv();
			
			
			return view('smtpDatosEmail');
				
        
    }
}
