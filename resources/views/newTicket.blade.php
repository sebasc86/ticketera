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

	

	
	<div class="container">
		<form action="" name="newTicket" method="post" enctype="multipart/form-data">
		{{csrf_field()}}
		  <div class="form-group">
		    <label for="exampleFormControlInput1">Email address</label>
		    <input type="text" name="email" class="form-control" id="email" placeholder="name@example.com">
		   	@if($errors->has('email'))
		    <div class="alert alert-danger">
		        {{ $errors->first('email') }}
		    </div>
		    @endif
		  </div>
		   <div class="form-group">
		    <label for="exampleFormControlInput1">Name</label>
		    <input type="text" name="name" class="form-control" id="name" placeholder="name@example.com">
		    @if($errors->has('name'))
		    <div class="alert alert-danger">
		        {{ $errors->first('name') }}
		    </div>
		    @endif
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlSelect1">Descripcion</label>
		    <select class="form-control" id="description" name='description'>
		      <option>1</option>
		      <option>2</option>
		      <option>3</option>
		      <option>4</option>
		      <option>5</option>
		    </select>
		  </div>
		  <div class="form-group">
		    <label for="exampleFormControlInput1">Nro de cliente</label>
		    <input type="text" class="form-control" id="clientN" name="clientN" placeholder="name@example.com">
		  </div>

		  <div class="form-group">
		    <label for="exampleFormControlTextarea1">Detalle</label>
		    <textarea class="form-control" name='details' id="details" rows="3"></textarea>
		  </div>
		  <input class="btn btn-primary" type="submit" value="Submit">
		</form>
	</div>
	
	
</body>
</html>