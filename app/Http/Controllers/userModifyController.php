<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Validator;
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

    public function index(Request $request, $id)
    {   
				$request->session()->put('user_id', $id);

				$user = User::find($id);
				$sectors = Sector::All();
        
        if(is_null($user)){
            return abort(403, "Usuario no encontrado");
        }

        return view('userModify')
																->with('user', $user)
																->with('sectors', $sectors);

		}
		
		public function update (Request $request){

			$userId = $request->session()->get('user_id');

			$data = $request->data;			
			
    	// $rules = [
      //   'sector' => 'required|numeric|exists:sectors,id',
	    //   'admin' => 'required|integer|min:0,max:1',
	    //   'email' => 'integer|email|max:255',
			// 	'name' => 'required|integer',
    	// ];
			//	$validator = Validator::make($data,$rules)

			$validator = Validator::make($data, [
        'sector' => 'required|numeric|exists:sectors,id',
	      'admin' => 'required|integer|between:0,1',
	      'email' => 'string|email|max:255',
				'name' => 'required|string',
    	],[
				'admin.required' => 'El nivel de privilegio no puede estar vacio',
				'admin.integer'=>'El el numero tiene que ser un numero',
				'admin.between'=> 'Es Admin tiene que estar entre :min y :max.',
				'sector.required' => 'El sector es requerido',
				'sector.numeric' => 'El sector es tiene que ser un número',
				'sector.exists' => 'El sector es tiene que ser válido',
				'name.required' => 'El nombre es obligatorio',
				'name.string' => 'Debe ser una cadena de caracteres',
			]);
			
			
			if ($validator->passes()) {
						//busco usuario a modificar
						$user = User::find($userId);

						//chequeo si email en DB
						$existEmail = User::where('email', $data['email'])->first();

						//si no es null y son diferentes al mail del usuario quiere decir que esta en uso por otro ahi corta ejecucion y devuelve error, si no almacena 
						if($existEmail != null && $user->email != $data['email']) {
							return response()
															->json([
																		'success' => $data['email'],
																		'errorEmail'=> 'El mail esta en uso',				
																]);
						}	else {
							$user->email = $data['email'];
						}
						
						//si password es diferente a null almacena nuevo pass
						if($data['pass'] != null) {
							$user->password = bcrypt($data['pass']);
						}

						//si pasa el validador updetea user
						$user->name = $data['name'];
						$user->isAdmin = $data['admin'];
						$user->sector_id = $data['sector'];

						$user->update();

						return response()->json([
							'success' => '1',
						]);

			} else {
					$validator = $validator->errors();
					return response()->json([
						'success' => '0',
						'errors' => $validator,
					]);
			}
		

			

		}

}
