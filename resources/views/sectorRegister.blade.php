@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nuevo Sector') }}</div>

                <div class="card-body">
                    <form id="form" method="POST" action="{{ asset('sector') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="sector" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
												</div>
												

												<div class="form-group row">
                            <label for="sector" class="col-md-4 col-form-label text-md-right">{{ __('Email Jefe sector') }}</label>

                            <div class="col-md-6">
                                <input id="email_boss" type="email" class="form-control{{ $errors->has('email_boss') ? ' is-invalid' : '' }}" name="email_boss" value="{{ old('email_boss') }}" required autofocus>

                                @if ($errors->has('email_boss'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email_boss') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                    



                        <div class="form-group row">
                            <label for="isAdmin" class="col-md-4 col-form-label text-md-right">{{ __('Es Admin') }}
                            </label>
                            <div class="col-md-6">
                                <select class="form-control {{ $errors->has('isAdmin') ? ' is-invalid' : '' }}" id="isAdmin" name='isAdmin'>

                                    <option value='0'>No</option>         
                                    <option value='1'>Si</option>

                                </select>   

                                @if ($errors->has('isAdmin'))
                                    <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('isAdmin') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>
                            <div class="col-md-6"> 
                            <input id="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email"  value="{{ old('email') }}"required> 
														</div>
														<div class="col-12">									
															<span class="invalid-feedback d-flex" role="alert">
																	<strong class="m-auto p-2">{{ $errors->first('email') }}</strong>
															</span>
														</div>				
                          	
												</div>
												<div class="form-group row">
													<label class="col-md-4 col-form-label text-md-right" for="file">Subir Imagen</label>
													
													<div class="col-md-6">
														
														<input type="file" class=" " name="file" id="file">
														<span class="small text-muted">128px * 30px recomendado solo PNG</span>
													</div>
												</div>	


                        

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Crear') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
  
    <script src="{{ asset('js/index.js') }}"></script>

@endpush
