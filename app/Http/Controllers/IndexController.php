<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sector;
use App\User;
use App\Ticket;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index()
    {		




			$user = Auth::user();

			$sectorId= $user->sector->id;
			
			//busco tickets al usuario 'queue' que coincide con mi sector
			//dado que mi sector en si tiene un usuario creado.

			$ticketsAll = Ticket::where('queue', $sectorId)->get();
			

			$ticketsOpen = $ticketsAll->filter(function($item, $key){

					return $item->status === 1;
					
			});
		
			$user = Auth::user();
			
			$sectors = Sector::all();
			$tickets = [];
			foreach ($sectors as $key => $value) {
				$tickets[$value->name] = Ticket::where('queue', $value->user_id)
				->where('status', 1)
				->get();
		
			}	
						
			
			if(isset($user)){
				
			$sector = $user->sector;
			return view('index')
								->with('sector', $sector)
								->with('sectors', $sectors)
								->with('tickets', $tickets);

			}
			
			return view('index')
								->with('sectors', $sectors)
								->with('tickets', $tickets);
       
    }
}
