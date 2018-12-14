<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Ticket;
use App\User;
use App\Sector;

class getContactcomController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index()
    {


        $tickets = Ticket::where('queue', Sector::CONTACTOM_TECNICA)->get();
        //busco tickets al usuario 'queue' que coincide con mi sector
        //dado que mi sector en si tiene un usuario creado.       

        $ticketsOpen = $tickets->filter(function($item, $key){

            return $item->status === 1;
            
        });
        
        $ticketsOpen->all();

		return view('getContactcom')->with('ticketsOpen', $ticketsOpen);

    }

    public function getTicketsContactcom()
    {   
        

    	$ticketsAll = Ticket::where('queue', Sector::CONTACTOM_TECNICA)->get();

        //lo paso a array para saber si esta vacio o no
        if( !$ticketsAll->isEmpty() ) {

            foreach ($ticketsAll as $key => $value) {
            	//para buscar el nombre Creador
            	$user = $value->user->name;
                $value->user_id = $user;
                $value->sector = $value->user->sector->name;

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
