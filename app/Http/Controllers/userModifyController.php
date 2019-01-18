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

    public function index(Request $request, $id)
    {   
        if(!is_numeric($id)){
            return abort(403, "Acceso Restringido");
        }

				$user = User::find($id);
				$sectors = Sector::All();
        
        if(is_null($user)){
            return abort(403, "Usuario no encontrado");
        }

        return view('userModify')
																->with('user', $user)
																->with('sectors', $sectors);

    }
}
