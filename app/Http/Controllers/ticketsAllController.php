<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Ticket;
use App\User;
use App\Sector;

class ticketsAllController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin'); 
    }
    
		public function index(Request $request)
    {   


        $user = Auth::user();
        
        //si sector es diferente a admin devuelvo error dado que no quiero que vean los tickets de sectores admin si no se podria hacer get/1 y traer algun tickets de un sector administrador.
        if($user->sector->isAdmin != 1) {
            return abort('403', 'Usted no tiene permisos para ingresar a esta pagina' );
        }
    
        //busco el ticket      

        $tickets = Ticket::all();

        //busco tickets al usuario 'queue' que coincide con mi sector
        //dado que el sector en si tiene un usuario creado y vinculado.      
         
        $ticketsOpen = $tickets->filter(function($item, $key){

            return $item->status === 1;
            
        });

        return view('ticketAll')
                          		->with('ticketsOpen', $ticketsOpen)
															->with('user', $user);

    }

    public function getTickets(Request $request)
    {       

				// $ticketsAll = Ticket::all();
				//para buscar el nombre a quien enviar
				$users = User::All(['id', 'name', 'email']);		
						
				foreach ($users as $key => $value) {
					$usersArray[$value->id] = $value;
				}
				
                
								$ticketsAll = DB::table('tickets')
                    ->join('users', 'users.id', '=', 'tickets.user_id')
										->leftjoin('sectors', 'sectors.user_id', '=', 'users.id')
                    ->select(['tickets.queue',
															'tickets.number',
															'tickets.client',
															'tickets.created_at',
															'tickets.close_user_id',
															'tickets.status',
															'users.name as user_name', 'sectors.name as sector_name'])
										->get();


						return Datatables::of($ticketsAll)
						->with([
										'users' => $usersArray,
									])
									->toJson();

    }
}
