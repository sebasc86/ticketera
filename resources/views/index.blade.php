@extends('layouts.master')

@section('content')
<div class="container flex">

	<h1> Bienvenido a TicketCall	</h1>

	<div class='index'>
		<a href="new">
			<img class='imgIndex' src="img/add_document.png" >
		</a>
		<a class="button btn btn-dark" href="new" role="button">Crear</a>
	</div>
		
	<div class='index'>
		<a href="sent">
			<img class='imgIndex' src="img/enviado.png" >
		</a>
		<a class="button btn btn-dark" href="sent" role="button">Enviados</a>
	</div>

  <div class='index'>
  	<a href="get">
  		<img class='imgIndex' src="img/recibido.png" >
  	</a>
  	
  	<a class="button btn btn-dark" href="get" role="button">Recibidos</a>
	</div>
	
</div>
@endsection

	
	
