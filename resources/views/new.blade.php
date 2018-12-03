@extends('layouts/master')

	@section('content')
		<div class="container mt-4 mb-5">
			<div class="fondo_modal">
				<div class="newModal">
					<img src="{{asset('img/loading.gif')}}">
				</div>
			</div>	

			<form action="" id="formTarget" name="newTicket" method="post" enctype="multipart/form-data">
			{{csrf_field()}}
			   <div class="form-group">
			    <label for="exampleFormControlInput1">Enviar a:</label>
			    <select class="form-control" id="queue" name='queue'>
			    @foreach ($usersAll as $user)
					<option value='{{ $user->id }}'>{{ $user->email }}</option>	       	
			    @endforeach
			    </select>
			    @if($errors->has('queue'))
		    			<span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('queue') }}</strong>
              </span>
			    @endif
			  </div>
			
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Nro de cliente</label>
			    <input id="clientN" type="clientN" class="form-control{{ $errors->has('clientN') ? ' is-invalid' : '' }}" name="clientN" value="{{ old('clientN') }}" placeholder='Ej: 454647'">

          @if ($errors->has('clientN'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('clientN') }}</strong>
              </span>
          @endif
			  </div>
				
			  <div class="form-group">
			    <label for="exampleFormControlInput1">Titulo</label>
			    <input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" value='{{ old('title') }}' placeholder="titulo">
			    @if ($errors->has('title'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('title') }}</strong>
              </span>
          @endif
			  </div>

				<div class="form-group">
					<label for="exampleFormControlInput1">Detalles</label>
				  <textarea class="summernote form-control {{ $errors->has('details') ? ' is-invalid' : '' }}" name='details' id="details" rows="3"></textarea>
				  @if ($errors->has('details'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('details') }}</strong>
            </span>
       	 	@endif
				</div>
				<div class="form-group">
					<input type="file" class="form-control form-control {{ $errors->has('file') ? ' is-invalid' : '' }}" name='file[]' id="file" multiple>
					 @if ($errors->has('file'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('file') }}</strong>
            </span>
       	 	@endif
				</div>
					<input class="btn btn-primary" id="submit" type="submit" value="Enviar">
				</form>

		</div>
@endsection

@push('scripts')

	<script type="text/javascript" src="{{ asset('js/new.js') }}"></script>

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
