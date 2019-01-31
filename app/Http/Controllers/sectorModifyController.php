<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Validator;
use App\Ticket;
use App\User;
use App\Sector;


class sectorModifyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin'); 
    }

    public function index(Request $request, $id)
    {   
				$request->session()->put('sector_id', $id);

				$sector = Sector::find($id);
        
        if(is_null($sector)){
            return abort(403, "Usuario no encontrado");
        }

        return view('sectorModify')
																->with('sector', $sector)
																->with('user', $sector->user->first());

		}

		public function update (Request $request){

			$sectorId = $request->session()->get('sector_id');

			$data = $request->data;
			
			$validator = Validator::make($data, [
				'name' => 'required|string',
				'email_boss' => 'string|email|max:255',
				'admin' => 'required|integer|between:0,1',
				'email' => 'string|email|max:255',
    	],[
				'admin.required' => 'El nivel de privilegio no puede estar vacio',
				'admin.integer'=>'El el numero tiene que ser un numero',
				'admin.between'=> 'Es Admin tiene que estar entre :min y :max.',
				'name.required' => 'El nombre es obligatorio',
				'name.string' => 'Debe ser una cadena de caracteres',
			]);
			
			
			if ($validator->passes()) {
						//busco usuario a modificar
						$sector = Sector::find($sectorId);
						$user = User::find($sector->user_id);

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

						$user->update();
						//si pasa el validador updetea user
						$sector->name = $data['name'];
						$sector->email_boss = $data['email_boss'];
						$sector->isAdmin = $data['admin'];

						$sector->update();
						

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
