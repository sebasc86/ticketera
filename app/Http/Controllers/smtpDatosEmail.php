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
        $this->middleware('admin');
    }

    public function index()
    {
			$emailEnv =	readEmailinEnv();
			$emailPassEnv =	readPassEmailinEnv();

			return view('smtpDatosEmail')
																	->with('emailPassEnv', $emailPassEnv)
																	->with('emailEnv', $emailEnv);


		}

		public function update()
    {

			$email = [];
			$email[] = request()->email;
			$email[] = request()->pass;

			$save = saveEnvEmail($email);

			$emailEnv =	readEmailinEnv();
			$emailPassEnv =	readPassEmailinEnv();

			if($save == 1) {
				$ok = 1;
			} else {
				$ok = 0;
			}

			return view('smtpDatosEmail')->with('ok', $ok)
																	->with('emailPassEnv', $emailPassEnv)
																	->with('emailEnv', $emailEnv);


    }
}
