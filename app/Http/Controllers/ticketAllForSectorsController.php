<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
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


        //guardo en session el id que viene desde el get
        $request->session()->put('sector_id', $id);
        //busco el usuario del ticket vinculado // si o si vinculado osea que no es el sector en si si no l usuario
        $user = User::find($id);

        $userLogin = Auth::user();
   

        //compruebo para que no arroje error el blade.
        //si no es numero devuelvo error 403
        if ( !is_numeric($id) || $user === null){
            return abort('403', 'Usted no tiene permisos para ingresar a esta pagina' );
        } 
        
        //si sector es diferente a admin devuelvo error dado que no quiero que vean los tickets de sectores admin si no se podria hacer get/1 y traer algun tickets de un sector administrador.
        if($user->sector->isAdmin != 0) {
            return abort('403', 'Usted no tiene permisos para ingresar a esta pagina' );
        }
    
        //busco el ticket      

        $tickets = Ticket::where('queue', $id)->get();

        //busco tickets al usuario 'queue' que coincide con mi sector
        //dado que el sector en si tiene un usuario creado y vinculado.      
         
        $ticketsOpen = $tickets->filter(function($item, $key){

            return $item->status === 1;
            
        });

        return view('ticketAllForSectors')
                                        ->with('ticketsOpen', $ticketsOpen)
                                        ->with('user', $user)
                                        ->with('userLogin', $userLogin);

    }

    public function getTickets(Request $request)
    {       
        $sector_id = $request->session()->get('sector_id');
				$users = User::All(['id', 'name', 'email']);
				foreach ($users as $key => $value) {
					$usersArray[$value->id] = $value;
				}
        
        //busco tickets al usuario 'queue' que coincide con mi sector
				// $ticketsAll = Ticket::select('queue','number', 'client', 'user_id', 'sector', 'close_user_id', 'created_at', 'updated_at', 'status')->where('queue', $sector_id)->get();

				$ticketsAll = DB::table('tickets')
<<<<<<< HEAD
				->where('queue', $sector_id)
				->whereNull('tickets.deleted_at')
=======
				->where('user_id', '=', $sector_id)
        ->whereNull('tickets.deleted_at')
>>>>>>> 4cac69857a7e430fdcaba21093d97863713423cd
				->join('users', 'users.id', '=', 'tickets.queue')
				->select(['tickets.queue',
									'tickets.number',
									'tickets.client',
									'tickets.created_at',
									'tickets.close_user_id',
									'tickets.status',
									'users.name as user_name'])
				->get();
				
				
				// $tickets = DB::table('tickets')
        //     ->join('users', 'tickets.user_id', '=', 'user.id')
        //     ->join('sectors', 'users.id', '=', 'sectors.user_id')
        //     // ->select('users.*', 'contacts.phone', 'orders.price')
				// 		->get();
						

        
        //lo paso a array para saber si esta vacio o no
        if( !$ticketsAll->isEmpty() ) {

        //     foreach ($ticketsAll as $key => $value) {
        //     	//para buscar el nombre Creador
        //     	$user = $value->user->name;
        //         $value->user_id = $user;
        //         $value->sector = $value->user->sector->name;                

        //         //para buscar el nombre a quien enviar
        //         $userQueue = $value->queue;
        //         $userQueue = User::find($userQueue);
        //         $userQueueName = $userQueue->name;
        //         $value->queue = $userQueueName; 

        //         if($value->status === 0){
        //             $value->status = 'Cerrado';
        //         } else {
        //             $value->status = 'Abierto';
        //         };

        //         $userCloseTicket = User::find($value->close_user_id);

        //         if($userCloseTicket != null) {
        //             $value->close_user_id = $userCloseTicket->name;
        //         }
        //     }
				// return response()->json(['success'=>'1']);
						
						return DataTables::of($ticketsAll)
                ->with([
                    'users' => $usersArray,
                ])
                ->toJson();

        } else {

            return Datatables::of($ticketsAll)->make(false);
            
        } 

		}
		
		
}
