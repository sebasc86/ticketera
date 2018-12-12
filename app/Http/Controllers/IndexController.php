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
    		$sector = Sector::All();
    		
    		if(isset($user)){
    			$sectorAdmin = $user->sector->isAdmin;
    			return view('index')
        	->with('sectorAdmin', $sectorAdmin)
        	->with('sector', $sector);
    		}
    		
    		return view('index');
       
    }
}
