<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Ticket;
use App\User;
use App\Sector;

class getTicketSectorController extends Controller
{	
	public function __construct()
    {
        $this->middleware('auth');
    }
    
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

		return view('getSector')->with('ticketsOpen', $ticketsOpen);

    }


	public function getTicketsSector()
    {   
        
        $user = Auth::user();
        $sectorId= $user->sector->id;

        
        $ticketsAll = Ticket::where('queue', $sectorId)->get();


        //lo paso a array para saber si esta vacio o no
        if( !$ticketsAll->isEmpty() ) {

            foreach ($ticketsAll as $key => $value) {
            	//para buscar el nombre Creador
            	$user = $value->user->name;
                $value->user_id = $user;
                $sectorName = $value->user->sector->name;
                $value->sector = $sectorName;
                //para buscar el nombre a quien enviar
                $userQueue = $value->queue;
                $userQueue = User::find($userQueue);
                $userQueueName = $userQueue->name;
                $value->queue = $userQueueName; 

                if($value->status === 0){
                    $value->status = 'Cerrado';
                } else {
                    $value->status = 'Abierto';
                };
            }

            return Datatables::of($ticketsAll)->make(true);

        } else {

            return Datatables::of($ticketsAll)->make(false);
            
        }    

    }

}
