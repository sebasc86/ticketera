@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modificar Password</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('users/{id}') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Nueva Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" disabled>
                                <i class="fa fa-pencil pencil" style="font-size:28px;color:gray"></i>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar Password') }}</label>

                            <div class="col-md-6">
                                
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" disabled>
                                
                                <i class="fa fa-pencil pencil" style="font-size:28px;color:gray"></i>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="submitButton" type="button" class="btn btn-primary">
                                    {{ __('Modificar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    		<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Informacion</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<span class="text-success mt-5 mb-5 p-2">El Usuario: {{$user->name}} ha sido actualizado.</span>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
	</div>
@endsection

@push('scripts')

	<script type="text/javascript" src="{{ asset('js/pass.js') }}"></script>
	
@endpush