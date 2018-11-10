<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class newTicketController extends Controller
{
     public function index()
    {
        return view('newTicket');
    }

    public function store()
    {
        
        $this->validate(request(), [       
          'name' => 'required|numeric',
          /*'email' => 'unique:users,email,'.$user->id,
          'password' => 'required|alpha_num|min:8|max:12',
          'password_confirmation' => 'required|same:password',
          'accion' => 'required|array',
          'accion.driver' =>  'min:1|max:1',
          'accion.co-driver' =>  'min:2|max:2',
          'profile_picture' => 'max:2048|mimes:jpg,jpeg,gif,png',*/
          ]);
        return redirect('newTicket');   

        
          
    }
}
