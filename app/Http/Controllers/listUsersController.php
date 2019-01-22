<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Yajra\Datatables\Datatables;
use App\Ticket;
use App\User;
use App\Comment;
use App\File;
use App\Sector;

class listUsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request) {
        return view('listUsers');
    }

    public function getUsers(Request $request)
    {
        $usersAll = USER::all();

          //lo paso a array para saber si esta vacio o no
          if( !$usersAll->isEmpty() ) {

            foreach ($usersAll as $key => $value) {
            	//para buscar el nombre Creador
                $sectorName = $value->sector->name;
                $value->sector_id = $sectorName ;

                if($value->isAdmin === 0){
                    $value->isAdmin = 'No';
                } else {
                    $value->isAdmin = 'Si';
                };
            }

            return Datatables::of($usersAll)->make(true);

        } else {

            return Datatables::of($usersAll)->make(false);
            
        }    

        return Datatables::of($usersAll)->make(true);
        
    }
}
