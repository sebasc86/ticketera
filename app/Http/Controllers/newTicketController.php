<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Ticket;
use App\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketMail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Swift_SwiftException;

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

		if(isset($usersArray)){
			return view('/new')->with('userLogin', $userLogin)->with('usersAll', $usersArray);
		} else {
			return view('/new')->with('userLogin', $userLogin)->with('usersAll', $users);
		}
		

		

    }

    public function store()
    {

		$user = Auth::user();
		$sector = $user->sector_id;
		$userId = $user->id;	
        
		$this->validate(request(), [    
/*		  'name' => 'required|numeric',
		  'email' => 'unique:users,email,'.$user->id,
		  'password' => 'required|alpha_num|min:8|max:12',
		  'password_confirmation' => 'required|same:password',
		  'accion' => 'required|array',
		  'accion.driver' =>  'min:1|max:1',
		  'accion.co-driver' =>  'min:2|max:2',
		  'profile_picture' => 'max:2048|mimes:jpg,jpeg,gif,png',*/
		  'queue' => 'required|numeric|exists:users,id',
		  'clientN' => 'nullable|numeric',
		  'title' => 'required|string',
		  'details' => 'required',
		  /*'file' => 'mimes:pdf,docx,doc,csv,xlsx,xls,docx,ppt,odt,ods,odp,zip',*/
		]);

		


		$details = request()->details;

		if($details) {
			$dom = new \domdocument();
		
        $dom->loadHtml($details, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getelementsbytagname('img');


        foreach($images as $k => $img){
            $data = $img->getattribute('src');
            
            /*dd(getimagesize($data));*/
 			
            list(, $data) = explode(',', $data);
 			
            $data = base64_decode($data);

            $data = Image::make($data);
            $sizeWidth = $data->width();

 			if($sizeWidth > 1000){
 				$data->resize(600, null, function ($constraint) {
			    $constraint->aspectRatio();
				});;
 			}
 			
 			
           
            $image_name = uniqid().'.png';
            
            $path = storage_path('app/public/uploads/files') .'/' . $image_name;

            $data->save($path, 40);

            $file = new File;
			$file->filename = $image_name;
			$file->save();

            $img->removeattribute('src');
            $img->setattribute('src', asset('view/20181123041/download/' . $image_name));
        }

	}
		
		$ticket = new Ticket;
		
		
		$ticket->status = $ticket->setOpenStatus();
		$ticket->sector = $ticket->setSectorId($sector);
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

		$userQueue = User::find($ticket->queue);
		

		try {
			Mail::to($userQueue->email)
			->cc($user->email)
			->send(new TicketMail($user, $ticket, $userQueue));
		} catch (Swift_SwiftException $e) {
			if($e->getCode() === 554) {
				$errorEmail = 'Destinatario Inválido';
				return $this->index()->with('errorEmail', $errorEmail);
			}
			
			
		}

        return redirect('view/'. $ticket->number);   
    }
}
