@extends('layouts.master')

@section('content')
<div class="container-fluid px-5 flex">

	<h1> Bienvenido a TicketCall	</h1>
  <div class="container-fluid flex">
		
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
					<a class="card-body link-container" href="get/sector/tickets">
							<div class=" row align-items-center" >
								<img class='imgIndex' src="img/sharing.png" alt="Tickets Generales del Sector">
							</div>
					</a>			
			</div>	
		</div>			
	</div>	


	@isset ($sector->isAdmin)
		@if($sector->isAdmin === 1)
		<div class="container-fluid flex">
			@isset($sectors)
				
					@foreach ($sectors as $sectorU)
						@if($sectorU->isAdmin != 1)

						<div class="row justify-content-between mt-4">
								<div class="hover card bg-light mb-3 info">
									<div class="card-header h6 bg-dark text-white d-flex justify-content-between">
										{{$sectorU->name}}
										<span id="{{$sectorU->id}}" class="badge badge-warning" style="
										position: absolute;
										right: 20px;
										">{{count($tickets[$sectorU->name])}}</span>
									</div>
									<a class="card-body link-container" href="get/{{$sectorU->user->first()->id}}">
											<div class="row align-items-center" >
												<img class='imgIndex' src="img/{{$sectorU->name}}.png"  alt="Abiertos {{$sectorU->name}}">
											</div>
									</a>
								</div>
						</div>

					@endif
					@endforeach
					
			@endisset
		</div>	
		@endif
	@endisset
		
		

	
</div>
@endsection

	
	
