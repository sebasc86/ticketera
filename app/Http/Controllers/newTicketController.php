<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use App\User;
use App\Sector;
use App\Ticket;
use App\File;
use App\Mail\TicketMail;
use App\Mail\SendMailable;
use App\Jobs\SendEmailJob;

use Swift_SwiftException;

class newTicketController extends Controller
{
    public function __construct()
    {
				$this->middleware('auth');
				$this->middleware('sectorAdmin');
    }

     public function index()
    {

    	$userLogin = Auth::user();
			$users =  User::all();

			$usersArray = $users->filter(function ($value, $key) {
			$userLogin = Auth::user();
				if($userLogin->sector->id === Sector::TELECENTRO_TECNICA){
					if($value->id != $userLogin->id){
              return $value;
					};
				}else {
					if(
							$value->id != $userLogin->id &&
                            //$value->sector_id != Sector::TELECENTRO_TECNICA &&
							$value->sector_id == Sector::TELECENTRO_TECNICA // activo envio de mails a sector telecentro
						){
							return $value;
						};
				}

			});

			if(isset($usersArray)){
				return view('/new')
													->with('userLogin', $userLogin)
													->with('usersAll', $usersArray);
			} else {
				return view('/new')
													->with('userLogin', $userLogin)
													->with('usersAll', $users);
			}




    }

    public function store()
    {

			$user = Auth::user();
			$sector = $user->sector_id;
			$userId = $user->id;

            $customMessages = [
                'max' => 'Lo maximo de subida es 10MB'
            ];


			$this->validate(request(), [
					'queue' => 'required|numeric|exists:users,id',
					'clientN' => 'nullable|numeric',
					'title' => 'required|string|max:25',
					'details' => 'required',
					'file' => 'array|max:10000',
					'file.*' => 'present|file|max:10000',
            ], $customMessages);

			$ticket = new Ticket;
			$ticket->status = $ticket->setOpenStatus();
			$ticket->sector = $ticket->setSectorId($sector);
			$ticket->queue = request()->queue;
			$ticket->client = request()->clientN;
			$ticket->title = request()->title;
			$ticket->user_id = $ticket->setUser($userId);
			$ticket->number = $ticket->setTicketNumber();
			$ticket->save();




			$details = request()->details;

			if($details) {
				$dom = new \domdocument();

	      $dom->loadHtml($details, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

	      $images = $dom->getelementsbytagname('img');


	      foreach($images as $k => $img){
					$data = $img->getattribute('src');
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

					$ticketSearch = Ticket::where('number', $ticket->number)->first();

					$file = new File;
					$file->filename = $image_name;
					$file->ticket_id =  $ticketSearch->id;
					$file->save();


					$path = storage_path('app/public/uploads/files') .'/' . $image_name;

					$data->save($path, 40);

					$img->removeattribute('src');
					$img->setattribute('src', asset('view/20181123041/download/' . $image_name));
	      }

		}

		$ticket->details = $details;
		$ticket->update();






			if(request()->file != null) {

					foreach (request()->file as $key => $value) {
						// Asignamos nombre para la DB
						$fileName = uniqid() . "." . $value->getClientOriginalExtension();
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
				// Mail::to($userQueue->email)
				// ->cc($user->email)
				// ->send(new TicketMail($user, $ticket, $userQueue));

				dispatch(new SendEmailJob($user, $ticket, $userQueue))
				->onConnection('database');

			} catch (Swift_SwiftException $e) {
				if($e->getCode() === 554) {
					$errorEmail = 'Destinatario Inválido';
					return $this->index()->with('errorEmail', $errorEmail);
				}

			}

	        return redirect('view/'. $ticket->number);
	    }
}
