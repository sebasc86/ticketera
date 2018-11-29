@extends('layouts/master')

	@section('content')
		<div class="container mt-4 mb-5">
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
@endsection

@push('scripts')

	<!-- include summernote css/js -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.js"></script>

	<!-- include summernote css/js -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.10/summernote-bs4.js"></script>

	<script>
	$(document).ready(function() {
	    $('.summernote').summernote({
					height: 300
				});

	});
	</script>
@endpush
