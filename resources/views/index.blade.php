@extends('layouts.master')

@section('content')
<div class="container flex">

	<h1> Bienvenido a TicketCall	</h1>
  <div class="container flex">
		<div class="row justify-content-between mb-3">
	        <div class="index card bg-light mb-3 info">
	          <div class="card-header h6 bg-primary text-white">Crear Nuevo Ticket</div>
	          <a class="card-body link-container"  href="new">
	            	<div class="row align-items-center">
									<img class='imgIndex' src="img/add_document.png" alt="Crear Ticket" >
								</div>
	          </a>
	        </div>
		</div>

		<div class="row justify-content-between mb-3">
	        <div class="index card bg-light mb-3 info">
	          <div class="card-header h6 bg-primary text-white">Mis Tickets Enviados</div>
	          <a class="card-body link-container" href="sent">
	            	<div class="a_index row align-items-center" >
									<img class='imgIndex' src="img/enviado.png" alt="Mis Tickets Enviados" >
								</div>
	          </a>
	        </div>
		</div>

		<div class="row justify-content-between mb-3">
	        <div class="index card bg-light mb-3 info">
	          <div class="card-header h6 bg-primary text-white">Mis Tickets Recibidos</div>
	          <a class="card-body link-container" href="get">
	            	<div class=" row align-items-center" >
									<img class='imgIndex' src="img/recibido.png" alt="Mis Tickets Recibidos" >
								</div>
	          </a>
	        </div>
		</div>


		<div class="row justify-content-between mb-3">
	        <div class="index card bg-light mb-3 info">
	          <div class="card-header h6 bg-primary text-white">Tickets Generales del Sector</div>
	          <a class="card-body link-container" href="get/sector">
	            	<div class=" row align-items-center" >
									<img class='imgIndex' src="img/sharing.png" alt="Tickets Generales del Sector">
								</div>
	          </a>
	        </div>
		</div>
	</div>	


		@isset ($sectorAdmin)
		  @if($sectorAdmin === 1)
			<div class="container flex">
				<div class="row justify-content-between mt-4">
			        <div class="hover card bg-light mb-3 info">
			          <div class="card-header h6 bg-dark text-white">Abiertos Atento</div>
			          <a class="card-body link-container" href="get/Atento">
			            	<div class=" row align-items-center" >
											<img class='imgIndex' src="img/atentoLogo.png" alt="Abiertos Atento" >
										</div>
			          </a>
			        </div>
				</div>

				<div class="row justify-content-between mt-4">
			        <div class="hover card bg-light mb-3 info">
			          <div class="card-header h6 bg-dark text-white">Abiertos ContactCom</div>
			          <a class="card-body link-container" href="get/sector">
			            	<div class=" row align-items-center" >
											<img class='contactcomImg' src="img/ContactCom.png"  alt="Abiertos ContactCom">
										</div>
			          </a>
			        </div>
				</div>

				<div class="row justify-content-between mt-4">
			        <div class="hover card bg-light mb-3 info">
			          <div class="card-header h6 bg-dark text-white">Abiertos Konecta</div>
			          <a class="card-body link-container" href="get/sector">
			            	<div class=" row align-items-center" >
											<img class='imgIndex' src="img/konecta.png"  alt="Abiertos Konecta">
										</div>
			          </a>
			        </div>
				</div>

				@endif
		@endisset
		
		

	
</div>
@endsection

	
	
