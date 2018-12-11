<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sector;


class sectorController extends Controller
{
    
     public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('admin'); 
    }

    public function index()
    {
        return view('sectorRegister');
    }

    public function store(){
 
		$this->validate(request(), [    		 
		  'name' => 'required|string|unique:sectors,name',
		  'isAdmin' => 'required|integer|min:0,max:1',
		]);

		$sector = new Sector;

		$sector->name = trim(request()->name);
		$sector->isAdmin = request()->isAdmin;
		$sector->save(); 

		return redirect('register'); 

    }

}
