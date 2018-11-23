@extends('layouts.master')

@section('content')
<div class="container">
	<h1>
		Welcome to the Support Center
	</h1>
	<p>	
		In order to streamline support requests and better serve you, we utilize a support ticket system. Every support request is assigned a unique ticket number which you can use to track the progress and responses online. For your reference we provide complete archives and history of all your support requests. A valid email address is required to submit a ticket.
	</p>

	  <a class="btn btn-success" href="new" role="button">Crear Tickets</a>
	  <a class="btn btn-warning" href="sent" role="button">Ver Tickets Enviados</a>
	  <a class="btn btn-warning" href="get" role="button">Ver Tickets Recibidos</a>
	
	
</div>
@endsection

	
	
