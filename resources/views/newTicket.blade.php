<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
	 <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TicketCall</title>
	
				<!-- Required meta tags -->
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

				<!-- Bootstrap CSS -->
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">		


	   		 <!-- include libraries(jQuery, bootstrap) -->
				<link href="http://netdna.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet">
				<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
				<!-- Popper JS -->
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

				<!-- Latest compiled JavaScript -->
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

				<!-- include summernote css/js -->
				<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.css" rel="stylesheet">
				<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.js"></script>

   		

  </head>
  
	<body>
		@include('header')

		
		<div class="container mt-4">
			<h2>Bienvenido a la creacion del ticket usuario: {{ $userLogin->name }}</h2>		
		</div>

		
		<div class="container mt-4">
			<form action="" name="newTicket" method="post" enctype="multipart/form-data">
			{{csrf_field()}}
			   <div class="form-group">
			    <label for="exampleFormControlInput1">Enviar a:</label>
			    <select class="form-control" id="queue" name='queue'>
			    @foreach ($usersAll as $user)
					<option value='{{ $user->id }}'>{{ $user->email }}</option>	       	
			    @endforeach
			    </select>	
			    @if($errors->has('name'))
			    <div class="alert alert-danger">
			        {{ $errors->first('name') }}
			    </div>
			    @endif
			  </div>
			
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Nro de cliente</label>
			    <input type="text" class="form-control" id="clientN" name="clientN" placeholder="4301751">
			  </div>

			  <div class="form-group">
			    <label for="exampleFormControlInput1">Titulo</label>
			    <input type="text" class="form-control" id="title" name="title" placeholder="titulo">
			  </div>

			  <div class="form-group">
			  	<label for="exampleFormControlInput1">Detalles</label>
			    <textarea class="summernote" name='details' id="details" rows="3"></textarea>
			 </div>
			 <div class="form-group">
				
				<input type="file" class="form-control-file" name='file[]' id="file" multiple>
			</div>
			  <input class="btn btn-primary" type="submit" value="Submit">
			</form>
		</div>
		
		  <script>
	    $(document).ready(function() {
	        $('.summernote').summernote();
	    });
	  </script>

			

	</body>
</html>