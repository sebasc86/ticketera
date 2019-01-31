<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Sector;
use App\User;


class sectorController extends Controller
{
    
     public function __construct()
    {
       $this->middleware('auth');
       $this->middleware('admin'); 
      // $this->middleware('guest');
    }

    public function index()
    {

        $sectors = Sector::all();
        return view('sectorRegister')->with('sectors', $sectors);

    }

    public function store(){
        
  		$this->validate(request(), [    		 
  		  'name' => 'required|string|unique:sectors,name',
				'isAdmin' => 'required|integer|min:0,max:1',
				'email_boss' => 'string|email|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'file.*' => 'max:2048|mimes:png',
      ]);

     
      
      if(request()->file != null) {
        // Asignamos nombre para la DB.
          $fileName = trim(request()->name) . "." . 'png';            
        // Almacenar la imagen en el servidor con el nuevo nombre
          $path = request()->file->move(public_path('img'), $fileName);     

          $path_photo = 'img/' . $fileName;  

          $img = Image::make($path_photo);
          
          if($img->width() > 128){
            $img->resize(128, 30);
          }

          $img->save($path_photo);
      }

   

      $sector = new Sector;
			$sector->name = trim(request()->name);
			$sector->email_boss = trim(request()->email_boss);
      $sector->isAdmin = request()->isAdmin;
      $sector->save(); 
  		
      if(request()->email != null){
          $user = new User;
          $user->name = trim(request()->name);
          $user->email = trim(request()->email);
          $user->isAdmin = request()->isAdmin;
          $user->password = Hash::make(request()->password);
          $user->sector_id = $sector->id;
          $user->save();

          $sector->user_id = $user->id;
          $sector->save(); 

      }

  		return redirect('register'); 

    }

}
