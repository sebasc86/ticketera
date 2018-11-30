<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ticket;
use App\File;
use Illuminate\Support\Facades\Auth;

class newTicketController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index()
    {

    	$userLogin = Auth::user();
    	$users =  User::all();
    	$usersArray;
    	foreach ($users as $value) {
    		if($value->id != $userLogin->id){
    			$usersArray[] = $value;
    		};
    	};

		return view('/new')->with('userLogin', $userLogin)->with('usersAll', $usersArray);

    }

    public function store()
    {

		$user = Auth::user();
		$userId = $user->id;	
        
		$this->validate(request(), [       
		  /*'name' => 'required|numeric',
		  'email' => 'unique:users,email,'.$user->id,
		  'password' => 'required|alpha_num|min:8|max:12',
		  'password_confirmation' => 'required|same:password',
		  'accion' => 'required|array',
		  'accion.driver' =>  'min:1|max:1',
		  'accion.co-driver' =>  'min:2|max:2',
		  'profile_picture' => 'max:2048|mimes:jpg,jpeg,gif,png',*/
		  /*'queue' => 'required|email|exists:users,email', */
		]);


		$details = request()->details;

		if($details) {
			$dom = new \domdocument();
		
        $dom->loadHtml($details, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getelementsbytagname('img');


        foreach($images as $k => $img){
            $data = $img->getattribute('src');
 
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
 
            $data = base64_decode($data);

            $image_name = uniqid().'.png';
            $folder = 'uploads/files';
            
            $path = storage_path('app/public/uploads/files') .'/' . $image_name;
           	 			
            file_put_contents($path, $data);
           
 
            $img->removeattribute('src');
            $img->setattribute('src', asset('view/20181123041/download/' . $image_name));
        }

        	$details = $dom->savehtml();
		}
		
		



		$ticket = new Ticket;
		
		
		$ticket->status = $ticket->setOpenStatus();
		$ticket->sector = 'chessecake';
		$ticket->queue = request()->queue;
	    $ticket->client = request()->clientN;
	    $ticket->title = request()->title;
	    $ticket->details = $details;
	    $ticket->user_id = $ticket->setUser($userId);
		$ticket->number = $ticket->setTicketNumber();
		$ticket->save();          
		
		
		
		if(request()->file != null) {

				foreach (request()->file as $key => $value) {
					// Asignamos nombre para la DB	
					$fileName = uniqid() . "." . $value->extension(); 
					// Defino la carpeta en la que voy a guardar la imagen
					$folder =  'uploads/files';
					// Almacenar la imagen en el servidor con el nuevo nombre
					$path =  $value->storeAs($folder, $fileName, 'public');
					// Salvamos el usuario para la data base.
					$file = new File;
					$file->ticket_id = $ticket->id;
					$file->filename = $fileName;
					$file->save();
				}
			    
		}


        return redirect('view/'. $ticket->number);   
    }
}
