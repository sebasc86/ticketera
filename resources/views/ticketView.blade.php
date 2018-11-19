<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	 <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TicketCall</title>
	<head>
   		 <!-- Required meta tags -->
   		 <meta charset="utf-8">
   		 <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  		  <!-- Bootstrap CSS -->
   		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">		

       <meta name="csrf-token" content="{{ csrf_token() }}" />
  	</head>
<body>
	@include('header')

  <div class='container mt-5'>
  
    
    <div class="row justify-content-between">
      <div class="bg-light col-5 border rounded ">
        <div class='row align-items-center'>
          <div class="col">
            <h1 class='h4 mt-2 border-bottom border-dark'>Basic Ticket Information</h1>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-6">
            <h2 class='h5'>Estado Ticket</h2>
          </div>
          <div class="col-6">
            

            <p id='status' class='h6'>{{ $ticket->status === 1 ? 'Abierto' : 'Cerrado' }}</p>
            
          </div>      
        </div>
        
        <div class="row  align-items-center">
          <div class="col-6">
            <h2 class='h5'>Departamento</h2>
          </div>
          <div class="col-6">
            <p class='h6'>{{$ticket->sector}}</h2>
          </div>      
        </div>

        <div class="row  align-items-center">
          <div class="col-6">
            <h2 class='h5'>Creado en:</h2>
          </div>
          <div class="col-6">
            <p class='h6'>{{$ticket->created_at}}</p>
          </div>      
        </div>

      </div>
      
   
      <div class="bg-light col-5 border rounded">
        <div class='row align-items-center'>
          <div class="col">
            <h1 class='h4 mt-2 border-bottom border-dark'>User Information</h1>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-6">
            <h2 class='h5'>Nombre Creador</h2>
          </div>
          <div class="col-6">
          <p class='h6'>{{$ticket->user->name}}</h2>
          </div>      
        </div>
        
        <div class="row  align-items-center">
          <div class="col-6">
            <h2 class='h5'>Correo</h2>
          </div>
          <div class="col-6">
            <p class='h6'>{{$ticket->user->email}}</p>
          </div>      
        </div>

        <div class="row  align-items-center">
          <div class="col-6">
            <h2 class='h5'>Sector</h2>
          </div>
          <div class="col-6">
            <p class='h6'>CheeseCake</p>
          </div>      
        </div>

      </div>


      


      <div class="w-100"></div>

      <div class="bg-light col-5 border rounded  mt-5 ">
        <div class='row align-items-center'>
          <div class="col">
            <h1 class='h4 mt-2 border-bottom border-dark'>{{$ticket->title}}</h1>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-6">
            <h2 class='h5'>Nro de cliente</h2>
          </div>
          <div class="col-6">
            <p class='h6'>{{$ticket->client}}</p>
          </div>      
        </div>
      </div>
     
    </div>
    <div class="row justify-content-between">
      <div class="bg-light col-12 border rounded  mt-5 ">
        <div class='row'>
          <div class="col">
            <h1 class='h4 mt-2 border-bottom border-dark text-center'>Detalle Ticket</h1>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col mt-2">
            <p class='h6'>{{$ticket->details}}</p>
          </div>      
        </div>
      </div>
    </div>  




      
      @if($ticket->comment)
      

      @foreach($ticket->comment as $dato)
      
        <div class="row justify-content-between">
          <div class="bg-light col-12 border rounded  mt-5 ">
            <div class='row'>
              <div class="col">
                <h1 class='h5 mt-2 border-bottom border-dark text-left'>Comentario:</h1>
              </div>
            </div>
            <div class="row align-items-center">
              <div class="col mt-2">
                <p class='h6'>{{$dato['comments']}}</p>
              </div>            
            </div>
            <div class="row align-items-center">
              <div class="col mt-2">
                <p class='text-right' style="margin-bottom: 0px">Creado por: {{($dato->user->name)}}  </p>
              </div>               
            </div>
            <div class="row align-items-center">
                <div class="col">
                    <p class='small text-right'>A las: {{$dato['created_at']}}hs </p>
                </div>               
            </div>
          </div>

          {{-- boton delete comentario -- por hacer --}}
          {{-- @if($dato->user->id === $userLoginId)
            <div class='row align-items-center'>
              <div class="col mt-5">
                <button type="button" id='buttonDelete' class="btn btn-danger">Delete</button>
              </div>    
            </div>
          @endif   --}}
        </div>  

        
      @endforeach
      @endif


      <div id="commentsNode">

          
          
      </div>
    
      <div class="row justify-content-between">
          
              <form class='bg-light col-5 border rounded  mt-5' action="" name="newComment" id='newComment' method="post" enctype="multipart/form-data">
                {{csrf_field()}}
                  
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1" class='mt-2'>Comentario</label>
                    <textarea class="form-control" name='comments' id="comments" rows="3"></textarea>
                  </div>
                  <div class="mt-4">
                    <input class="btn btn-primary" id='buttonSend' type="submit" value="Enviar">
                    <button type="button" id='buttonArea' class="btn btn-primary">Agregar comentario</button>
                  </div>  
              </form>
              

            
            @if($ticket->queue == $userLoginId)
            <form class='bg-light col-5 border rounded  mt-5' action="" name="close" id='closeTicket' method="post" enctype="multipart/form-data">
                {{csrf_field()}}
              <div class="col-2 mt-5 align-self-end">
                  <input class="btn btn-primary" id='close' type="submit" value="close">
              </div>
            </form>
            @endif 
              
      </div>

      


    </div>
  </div>

  
  
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  <script src="http://code.jquery.com/jquery-3.3.1.min.js"
               integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
               crossorigin="anonymous">
  </script>
  <script type="text/javascript" src="{{ asset('js/index.js') }}"></script>
 

</body>
</html>