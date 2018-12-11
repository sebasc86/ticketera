@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Nuevo Sector') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ asset('sector') }}">name
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