@extends('layouts.master')

@section('content')
<div class="container flex">

	<h1> Bienvenido a TicketCall	</h1>

	<div class="row justify-content-between">
        <div class="index card bg-light mb-3 info">
          <div class="card-header h6 bg-primary text-white">Crear</div>
          <a class="card-body"  href="new">
            	<div class="row align-items-center">
								<img class='imgIndex' src="img/add_document.png" >
							</div>
          </a>
        </div>
	</div>

	<div class="row justify-content-between">
        <div class="index card bg-light mb-3 info">
          <div class="card-header h6 bg-primary text-white">Enviados</div>
          <a class="card-body" href="sent">
            	<div class="a_index row align-items-center" >
								<img class='imgIndex' src="img/enviado.png" >
							</div>
          </a>
        </div>
	</div>

	<div class="row justify-content-between">
        <div class="index card bg-light mb-3 info">
          <div class="card-header h6 bg-primary text-white">Recibidos</div>
          <a class="card-body" href="get">
            	<div class=" row align-items-center" >
								<img class='imgIndex' src="img/recibido.png" >
							</div>
          </a>
        </div>
	</div>

	{{-- <div class='index'>
		<a href="new">
			<img class='imgIndex' src="img/add_document.png" >
		</a>
		<p class="">Crear</p>
	</div>
		
	<div class='index'>
		<a href="sent">
			
		</a>
		<p class="">Enviados</p>
	</div>

  <div class='index'>
  	<a href="get">
  		
  	</a>
  	
  	<p class="">Recibidos</p>
	</div> --}}
	
</div>
@endsection

	
	
