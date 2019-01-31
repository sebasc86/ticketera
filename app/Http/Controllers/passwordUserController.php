<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\User;


class passwordUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {   

			$user = Auth::user();
			
			if(is_null($user)){
					return abort(403, "Usuario no encontrado");
			}

			return view('passwordUser')
															->with('user', $user);

		}

		public function update (Request $request){

			$data = $request->data;
			
			//busco usuario a modificar
			$user = Auth::user();

			if($data['pass'] != null) {
				$user->password = bcrypt($data['pass']);
				
				$user->update();

				return response()->json([
					'success' => '1',
				]);

			} else {

				return response()->json([
					'success' => '0',
					'errorPass' => '*La contraseña no contiene datos',
				]);
				
			}

			
		}
	}
