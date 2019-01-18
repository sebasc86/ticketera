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
			
    	$rules = [
        'sector' => 'required|numeric|exists:sectors,id',
	      'admin' => 'required|integer|min:0,max:1',
	      'email' => 'string|email|max:255',
				'name' => 'required|string',
    	];

			$validator = Validator::make($data, $rules);
			if ($validator->passes()) {
						$user = User::find($userId);
						//chequeo si existe otro email
						$existEmail = User::where('email', $data['email'])->first();
						//si es null pega a la actualiacion del mail si no responde y corta ejecucion
						
						if($existEmail != null && $user->email != $data['email']) {
							return response()->json([
								'success' => $data['email'],
								'errorEmail'=> 'El mail esta en uso',				
								]);
						}	else {
							$user->email = $request->data['email'];
						}
						
						
						
						$user->name = $request->data['name'];
						$user->isAdmin = $request->data['admin'];
						$user->sector_id = $request->data['sector'];

						$user->update();
			} else {
					$validator = $validator->errors()->all();
			}
		

			return response()->json([
				'success' => '1',
				]);

		}

}
