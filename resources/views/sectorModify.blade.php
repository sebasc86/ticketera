@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modificar Sector') }}</div>

                <div class="card-body">
                    <form id="form" method="POST" action="{{ url('sectors/{id}') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                          <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                          <div class="col-md-6">
                              <input id="name" type="text" class="form-control" name="name" value="{{ $sector->name }}" required>
                              
                              <i class="fa fa-pencil pencil" style="font-size:28px;color:gray"></i>
                          
                          </div>
                        </div>

												<div class="form-group row">
                            <label for="sector" class="col-md-4 col-form-label text-md-right">{{ __('Email Jefe sector') }}</label>

                            <div class="col-md-6">
                              <input id="email_boss" type="text" class="form-control" name="email_boss" value="{{ $sector->email_boss }}" required>
                              
                              <i class="fa fa-pencil pencil" style="font-size:28px;color:gray"></i>
                          
                          </div>
                        </div>

                    



                        <div class="form-group row">
                          <label for="isAdmin" class="col-md-4 col-form-label text-md-right">{{ __('Es Admin') }}
                          </label>
                          <div class="col-md-6">
                              <select class="form-control" id="isAdmin" name='isAdmin'>

                                  @if ($sector->isAdmin != 1)
                                  <option value='0'>No</option>         
                                  <option value='1'>Si</option>
                                  @else 
                                  <option value='1'>Si</option>
                                  <option value='0'>No</option>    
                                  @endif
                                  

                              </select>   

                          </div>
                        </div>


                        <div class="form-group row">
                          <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                          <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                            <i class="fa fa-pencil pencil" style="font-size:28px;color:gray"></i>
                          
                            
                          </div>
                      </div>
                      
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
										
										<div class="form-group row">
												<label class="col-md-4 col-form-label text-md-right" for="file"> Imagen</label>
												
												<div>
														<img class='imgIndex' src="{{ asset("img/" . $user->name . ".png") }}">
												</div>
										</div>	

                    <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="file">Cambiar Imagen</label>
                            
                            <div class="col-md-6">
                                
                                <input type="file" class="file" name="file" id="file">
                                <span class="small text-muted">128px * 30px recomendado solo PNG</span>
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
    <script src="{{ asset('js/sectorModify.js') }}"></script>
@endpush
