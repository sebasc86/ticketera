@extends('layouts.master')

  
  
  @section('content')


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
            {!! $ticket->details !!}
          </div>      
        </div>

     
            
        <div class="col mt-2">

          @foreach ($files as $file)
          
          <ul class="list group d-flex mt-2" style="padding: 0px; margin: 0">
            <li class="list-group-item d-flex p-2">
              <span class="p-1 oi oi-data-transfer-download" title="person" aria-hidden="true"></span>
              <a class="" href="{{url('/view/'. $ticket->number .'/download/'.$file->filename)}}" download>{{ $file->filename }}</a>
            </li> 
          </ul>

          @endforeach

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
      
     

      <div id="commentsNode"></div>
    
      <div class="row justify-content-between">
          
              <form class='bg-light col-5 border rounded  mt-5' action="" name="newComment" id='newComment' method="post" enctype="multipart/form-data">
                
                  
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
               
              <div class="col-2 mt-5 align-self-end">
                  <input class="btn btn-primary" id='close' type="submit" value="close">
              </div>
            </form>
            @endif 
              
      </div>

      


    </div>
  </div>
@endsection
  
@push('scripts')


  <script type="text/javascript" src="{{ asset('js/index.js') }}"></script>

  <!-- include summernote css/js -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.js"></script>

  <!-- include summernote css/js -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.js"></script>
 

@endpush