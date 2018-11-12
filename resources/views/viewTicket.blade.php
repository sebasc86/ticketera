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
  <table class="tabla">
      
        <tr>
          <th>Empresa</th>  
          <th>Categoria</th>
          <th>Material</th>
          <th>Descripción</th>
          <th>Fecha</th>
        </tr>
  @if($tickets)

    @foreach($tickets as $dato)

    <tr>
          <td>{{ $dato->id }}</td>
          <td>{{ $dato->status }}</td>
          <td>{{ $dato->apartament }}</td>
          <td>{{ $dato->number }}</td>
          <td>{{ $dato->client }}</td>
          <td>{{ $dato->user_id }}</td>
          <td>{{ $dato->created_at }}</td>
    </tr>
    @endforeach
  @else
        todavia no hay reportes generados
  @endif
  </table>

</body>
</html>  