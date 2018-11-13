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
            <p class='h6'>Abierto</p>
          </div>      
        </div>
        
        <div class="row  align-items-center">
          <div class="col-6">
            <h2 class='h5'>Departamento</h2>
          </div>
          <div class="col-6">
            <p class='h6'>BOT</h2>
          </div>      
        </div>

        <div class="row  align-items-center">
          <div class="col-6">
            <h2 class='h5'>Creado en:</h2>
          </div>
          <div class="col-6">
            <p class='h6'>15/6/18 13:52</p>
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
            <p class='h6'>Sebastián Coscia</h2>
          </div>      
        </div>
        
        <div class="row  align-items-center">
          <div class="col-6">
            <h2 class='h5'>Correo</h2>
          </div>
          <div class="col-6">
            <p class='h6'>scoscia@telecentro.net.ar</p>
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
            <h1 class='h4 mt-2 border-bottom border-dark'>Descripcion//Titulo</h1>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col-6">
            <h2 class='h5'>Nro de cliente</h2>
          </div>
          <div class="col-6">
            <p class='h6'>4301751</p>
          </div>      
        </div>
      </div>
     
    </div>

      <div class="bg-light col border rounded  mt-5 ">
        <div class='row'>
          <div class="col">
            <h1 class='h4 mt-2 border-bottom border-dark text-center'>Detalle Ticket</h1>
          </div>
        </div>
        <div class="row align-items-center">
          <div class="col mt-2">
            <p class='h6'>BlaBla bla</p>
          </div>      
        </div>
      </div>

    {{-- <div class="row align-items-center mt-5">
      <div class="col-12">
        <h1 class='h4 text-center'>Detalle Ticket</h1>
        <div class="row  align-items-center">
          <div class="col-6">
            <p class='mt-2'>BlaBla bla</h1>
          </div>    
        </div>
      </div>
    </div> --}}
  </div>
  
</body>
</html>