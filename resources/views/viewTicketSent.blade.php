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
  <!-- <table class="tabla">
      
        <tr>
          
          <th>Estado</th>
          <th>Sector</th>
          <th>Nro ticket</th>
          <th>Cliente</th>
          <th>Descripcion</th>
          <th>Detalles</th>
          <th>User</th>
          <th>Creado</th>
          
        </tr>
  
  </table> -->

  <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Estado</th>
      <th scope="col">Sector</th>
      <th scope="col">Nro ticket</th>
      <th scope="col">Cliente</th>
      <th scope="col">Descripcion</th>
      <th scope="col">Detalles</th>
      <th scope="col">User</th>
      <th scope="col">Creado</th>
      
    </tr>
  </thead>
  <tbody>
  @if($tickets)

    @foreach($tickets as $dato)

    <tr>
          <td>{{ $dato->status }}</td>
          <td>{{ $dato->apartament }}</td>
          <td>{{ $dato->number }}</td>
          <td>{{ $dato->client }}</td>
          <td>{{ $dato->description }}</td>
          <td>{{ $dato->details }}</td>
          <td>{{ $dato->user_id }}</td>
          <td>{{ $dato->created_at }}</td>
          <td><a class="btn btn-primary" href="/ticketView/{{ $dato->number }}" role="button">Ver mas</a></td>
    </tr>
    @endforeach
  @else
        todavia no hay reportes generados
  @endif

 

  </tbody>
  <hr>
</table>


</body>
</html>  