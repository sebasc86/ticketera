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


			$userAuth = Auth::user();
			$sectorsAll = Sector::all();
			
			
		

			if(isset($userAuth)){
				$sectorUser = $userAuth->sector;
				$sectorId = $userAuth->sector->user_id;
				$userId = $userAuth->id;   

				$ticketsQueueUser= Ticket::where('queue', $userId)->get();
        
        $ticketsOpenUser = $ticketsQueueUser->filter(function($item, $key){

            return $item->status === 1;
            
        });
        
        //busco tickets al usuario 'queue' que coincide con mi sector
        //dado que mi sector en si tiene un usuario creado.

        $ticketsAllSector = Ticket::where('queue', $sectorId)->get();
        

        $ticketsOpenSector = $ticketsAllSector->filter(function($item, $key){

            return $item->status === 1;
            
        });

				

				$tickets = [];
				foreach ($sectorsAll as $key => $value) {
					$tickets[$value->name] = Ticket::where('queue', $value->user_id)
					->where('status', 1)
					->get();
				}						
				
				return view('index')
								->with('sector', $sectorUser)
								->with('sectors', $sectorsAll)
								->with('tickets', $tickets)
								->with('ticketsSector', $ticketsOpenSector)
								->with('ticketsUser', $ticketsOpenUser);

			} 
			
			return view('index')
								->with('sectors', $sectorsAll);
       
    }
}
