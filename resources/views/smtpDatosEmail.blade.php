@extends('layouts.master')

@section('content')
	<div class="container">
			<div class="row justify-content-center">
					<div class="col-md-8">
							<div class="card">
									<div class="card-header">Modificar Usuario</div>

									<div class="card-body">
											<form method="POST" action="/smtpDatosEmail/update">
													@csrf

													<div class="form-group row">
															<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email Smtp') }}</label>

															<div class="col-md-6">
																	<input id="email" type="text" class="form-control" name="email" value="{{ $emailEnv }}" required>
																	
																	<i class="fa fa-pencil pencil" style="font-size:28px;color:gray"></i>
															
															
															</div>
													</div>

													<div class="form-group row">
															<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

															<div class="col-md-6">
																<input id="pass" type="password" class="form-control" name="pass" value="{{ $emailPassEnv }}">
																<i class="fa fa-pencil pencil" style="font-size:28px;color:gray"></i>
															

															</div>
													</div>
													@if (isset($ok) && $ok != 0)
													<div class="form-group row">
															<div class="col-md-12">
															<p class="h6 text-danger text-center">Actualizado</p>
															</div>
													</div>
													@endif
													
												
													<div class="form-group row mb-0">
															<div class="col-md-6 offset-md-4">
																	<input value="Modificar" id="submitButton" type="submit" class="btn btn-primary">
																			
																	
															</div>
													</div>
											</form>
									</div>
							</div>
					</div>
			</div>
		
@endsection
