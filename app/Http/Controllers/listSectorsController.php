<?php

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

class listSectorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(Request $request) {
        return view('listSectors');
    }

    public function getSectors(Request $request)
    {
        $sectorsAll = Sector::all();

          //lo paso a array para saber si esta vacio o no
          if( !$sectorsAll->isEmpty() ) {

            foreach ($sectorsAll as $key => $value) {

                if($value->isAdmin === 0){
                    $value->isAdmin = 'No';
                } else {
                    $value->isAdmin = 'Si';
                };
            }

            return Datatables::of($sectorsAll)->make(true);

        } else {

            return Datatables::of($sectorsAll)->make(false);
            
        }    
        
		}
}
