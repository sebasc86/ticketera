<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Ticket;
use App\User;
use App\Sector;

class ticketAllForSectorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
	public function index(Request $request, $id)
    {

        $request->session()->put('sector_id', $id);
        $sector = Sector::find($id);

        $tickets = Ticket::where('queue', $id)->get();
        //busco tickets al usuario 'queue' que coincide con mi sector
        //dado que mi sector en si tiene un usuario creado.       
        $ticketsOpen = $tickets->filter(function($item, $key){

            return $item->status === 1;
            
        });
        
        $ticketsOpen->all();

        return view('ticketAllForSectors')
                                        ->with('ticketsOpen', $ticketsOpen)
                                        ->with('sector', $sector);

    }

    public function getTickets(Request $request)
    {       
        $sector_id = $request->session()->get('sector_id');

    	$ticketsAll = Ticket::where('queue', $sector_id)->get();

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
