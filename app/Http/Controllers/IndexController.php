<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sector;

class IndexController extends Controller
{
    public function index()
    {		


    		$user = Auth::user();

    		
    		if(isset($user)){
    			
    		$sector = $user->sector;
    		return view('index')
        	->with('sector', $sector);

    		}
    		
    		return view('index');
       
    }
}
