@extends('layouts/master')

	@section('content')
		<div class="container mt-4 mb-5">
			<div class="fondo_modal">
				<div class="newModal">
					<img src="{{asset('img/loading.gif')}}">
				</div>
			</div>	

			<form  id="formTarget" action="" name="newTicket" method="post" enctype="multipart/form-data">
			{{csrf_field()}}
			   <div class="form-group">
			    <label for="exampleFormControlInput1">Enviar a:</label>
			    <select class="form-control is-valid" id="queue" name='queue'>
			    @foreach ($usersAll as $user)
					<option value='{{ $user->id }}'>{{ $user->email }}</option>	       	
			    @endforeach
					</select>
					@isset($errorEmail)
					<span class="invalid-input">
						<strong>{{ $errorEmail }}</strong>
					</span>
				@endisset
			    @if($errors->has('queue'))
		    	<span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('queue') }}</strong>
              	</span>
			    @endif
			  </div>
			
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Nro de cliente</label>
			    <input id="clientN" type="clientN" class="form-control{{ $errors->has('clientN') ? ' is-invalid' : '' }}" name="clientN" value="{{ old('clientN') }}" placeholder="Ej: 454647 Máximo 10 números">
		  
          @if ($errors->has('clientN'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('clientN') }}</strong>
              </span>
          @endif
			  </div>
				
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Titulo</label>
			    <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" value='{{ old('title') }}' placeholder="Maximo 10 caraceteres">
			    @if ($errors->has('title'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('title') }}</strong>
              </span>
          @endif
			  </div>

				<div id='summernote' class="form-group">
					<label for="exampleFormControlInput1">Detalles</label>
				  <textarea class="summernote form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" name='details' id="details" rows="3"></textarea>
				  @if ($errors->has('details'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('details') }}</strong>
            </span>
       	 	@endif
       	 	<div class="none">
       	 		<span class="invalid-feedback" role="alert">
                <strong>Su ticket esta vacio</strong>
          	</span>
       	 	</div>
				</div>
				<div class="form-group">
					<input type="file" class="form-control form-control {{ $errors->has('file') ? ' is-invalid' : '' }}" name='file[]' id="file" multiple>
					@for ($i = 0; $i < count($errors); $i++)
						@if ($errors->has('file.'.$i))
						<span class="invalid-input" role="alert">
								<strong>{{ $errors->first('file.'.$i) }}</strong>
						</span>
						@endif
					@endfor
				</div>
					<input class="btn btn-primary" id="submitButton" type="submit" value="Enviar" disabled>
				</form>

		</div>
@endsection

@push('scripts')

	<script type="text/javascript" src="{{ asset('js/new.js') }}"></script>
	

	<link rel="stylesheet" type="text/css" href="{{ asset('dist/summernote-bs4.css') }}">
	<script src="{{ asset('dist/summernote-bs4.min.js') }}"></script>

	<script>
	$(document).ready(function() {
	    $('.summernote').summernote({
					height: 300
				});

	    $('#formTarget').on('submit', function(e) {
  			$('#error-label').remove()
			  if($('.summernote').summernote('isEmpty')) {
			    $('#summernote').append('<span id="error-label"><strong class="invalid-input">El campo es requerido.</strong></span>')
			    e.preventDefault();
			  }
			  else {
			  }
			})
	});
	</script>
@endpush
