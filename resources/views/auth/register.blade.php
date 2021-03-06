@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
												
                         <div class="form-group row">
                            <label for="sector_id" class="col-md-4 col-form-label text-md-right">{{ __('Sector') }}</label>

                            
                                
                                @if(count($sectors) > 0)
                                <div class="col-md-6">
                                    <select class="form-control {{ $errors->has('sector_id') ? ' is-invalid' : '' }}" id="sector_id" name='sector_id'>

                                    @foreach ($sectors as $sector)
                                        <option value="{{$sector->id }}">{{$sector->name}}</option>
                                    @endforeach

                                    </select>
                                </div>    
                                @else 
                                <div class="col-md-6" style="margin-left:5px; padding: 10px;color: #d40000;font-size: 14px;">
                                    <span class="invalid">
                                        <strong class="">Debe Crear un sector previamente</strong>
                                    </span>
                                </div>
                                @endif
                                   
                                        
                                    

                                @if ($errors->has('sector_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('sector_id') }}</strong>
                                    </span>
                                @endif
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
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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

	<script type="text/javascript" src="{{ asset('js/index.js') }}"></script>
	
@endpush