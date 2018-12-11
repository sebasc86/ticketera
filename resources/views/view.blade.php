@extends('layouts.master')

  
  
@section('content')

  
  
  <div class='container mt-5'>
    
    <div class="row justify-content-between">
      <div class="col-5">
        <div class="card bg-light mb-3 info">
          <div class="card-header h5 bg-primary text-white">Información del Tickets</div>
          <div class="card-body">
            <div class="row align-items-center">
              
              <div class="col-6">
                <h2 class='h5'>Estado Ticket: </h2>
              </div>

              <div class="col-6">
                <p id='status' class='h6'>{{ $ticket->status === 1 ? 'Abierto' : 'Cerrado' }}</p>
              </div>

              <div class="col-6">
                <h2 class='h5'>Creado en:</h2>
              </div>

              <div class="col-6">
               <p class='h6'>{{$ticket->created_at}}</p>
              </div>

              <div class="col-6">
               <h2 class='h5'>Enviado a:</h2>
              </div>

              <div class="col-6">
               <p class='h6'>{{$userSent->name}}</p>
              </div>   

              <div class="col-6">
                <h2 class='h5'>Sector:</h2>
              </div>

              <div class="col-6">
                <p class='h6'>{{$sectorQueue->name}}</h2>
              </div>

            </div>



          </div>
        </div>
      </div>  
      
      <div class="col-5">
        <div class="card bg-light mb-3 info">
          <div class="card-header h5 bg-primary text-white">Usuario Información</div>
          <div class="card-body">
            <div class="row align-items-center">
              
              <div class="col-6">
                <h2 class='h5'>Nombre Creador</h2>
              </div>

              <div class="col-6">
                <p class='h6'>{{$ticket->user->name}}</h2>
              </div>   

              <div class="col-6">
                <h2 class='h5'>Correo</h2>
              </div>

              <div class="col-6">
                <p class='h6'>{{$ticket->user->email}}</p>
              </div>

              <div class="col-6">
                <h2 class='h5'>Sector</h2>
              </div>
              <div class="col-6">
                <p class='h6'>{{$ticket->user->sector->name}}</p>
              </div>    
            </div>
          </div>
        </div>
      </div>  

      <div class="col-12">
        <div class="card bg-light mb-3 info">
          <div class="card-header h5 bg-dark text-white">Ticket</div>
          <div class="card-body">
            <div class="row align-items-center">

              <div class="col-6">
                <h2 class='h5'>Nro de cliente</h2>
              </div>
              <div class="col-6">
                <p class='h6 text-center'>{{$ticket->client}}</p>
              </div>   

              <div class="col-6">
                <h2 class='h5'>Título:</h2>
              </div>
              
              <div class="col-6">
                <p class='h6 text-center'>{{$ticket->title}}</p>
              </div>
              
              <div class="col-12">
                <hr>
                <p class='h5 mt-3 mb-3 font-weight-bold'>Detalles:</p>

              </div>

                            
              <div class="col mt-2">
                {!! $ticket->details !!}
              </div>      
              
              <div class="col-12 mt-2">

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
        </div>
      </div>
      
    
      <div class="col-12" id="commentsNew"></div>

     @if(!$ticket->comment->isEmpty())
      
      <div class="col-12">
        <div class="card bg-white mb-3 info">
          <div class="card-header h6 bg-secondary text-white">Comentarios</div>
          <div class="card-body">
            
      @foreach($ticket->comment as $dato)
      
            
            <div class="row align-items-center bg-light mt-2 info">

              <div class="col mt-4">
                <p class=''>{{$dato['comments']}}</p>
              </div>  

              <div class="col-12 mt-2">
                <p class='text-right text-muted' style="margin-bottom: 0px">Creado por: {{($dato->user->name)}}  </p>
              </div>

              <div class="col-12">
                <p class='small text-right text-muted'>A las: {{$dato['created_at']}}hs </p>
              </div>
              
              @foreach ($dato->file as $file)
                <div class="col-12 mb-3">
                  <a class="small" href="{{url('/view/'. $ticket->number .'/download/'.$file->filename)}}" download>{{ $file->filename }}</a>
                </div>
              @endforeach  
  
                             
            </div>
            



            
      @endforeach

      <div id="commentsNode"></div>
      </div>
      </div>
      </div>
      
      @endif

      

    @if($ticket->status != 0)
    
      <div class="col-9">
        
        <form class='bg-light col-12 border rounded  mt-5' action="" name="newComment" id='newComment' method="post" enctype="multipart/form-data">

         <div class="form-group">
          <label for="exampleFormControlTextarea1" class='mt-2'>Comentario</label>
          <textarea class="form-control" name='comments' id="comments" rows="3"></textarea>
          </div>
          <div class="mt-4">
            <input class="btn btn-primary" id='buttonSend' type="submit" value="Enviar">
            <button type="button" id='buttonArea' class="btn btn-primary">Agregar comentario</button>
            <input type="file" class="form-control form-control mt-2" name="file[]" id="file" multiple="">
          </div>
          
         </div>    
        </form> 
                  

        @if($ticket->queue == $userLoginId  || $sectorQueue->id == $userSent->sector_id)
            <form class='mt-5' action="" name="close" id='closeTicket' method="post" enctype="multipart/form-data">
               
              <div class="mt-5 pr-3 align-self-end">
                  <input class="btn btn-primary" id='close' type="submit" value="Cerrar Ticket">
              </div>
            </form>
        @endif 


      </div>

    @endif  


  

@endsection


  
@push('scripts')


  <script type="text/javascript" src="{{ asset('js/index.js') }}"></script>

  <!-- include summernote css/js -->
  <link rel="stylesheet" type="text/css" href="{{ asset('dist/summernote-bs4.css') }}">
  <script src="{{ asset('dist/summernote-bs4.min.js') }}"></script>
 

@endpush