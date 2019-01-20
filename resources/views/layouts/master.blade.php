<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
	 <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>TicketCall</title>
	
				<!-- Required meta tags -->
				<meta charset="utf-8">
				<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                <meta name="csrf-token" content="{{ csrf_token() }}" />

				<!-- Bootstrap CSS -->
				<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">		
                


	   		    <!-- include libraries(jQuery, bootstrap) -->
				<link href="http://netdna.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.css" rel="stylesheet">
				<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
				<!-- Popper JS -->
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

				<!-- Latest compiled JavaScript -->
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

              
                
				{{-- agregado el datatables --}}
				<link rel="stylesheet" type="text/css" href="{{asset( 'css/index.css' )}}">
				<link rel="stylesheet" type="text/css" href="{{asset( 'css/view.css' )}}">

				{{-- font-awesome--}}
				<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
                
        
               
  </head>

<body>
    
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand px-4" href="{{ url('/') }}">
                {{ 'Telecentro' }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">

                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto px-3">
                    <!-- Authentication Links -->
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        
                    @else
                        
                        <li class="nav-item dropdown">

                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            
                            <div class="dropdown-menu dropleft menudown" aria-labelledby="navbarDropdown">



																@if ( Route::has('register') && (Auth::user()->isAdmin == 1) )
																		
																		<a class="dropdown-item dropdown-toggle" href="#">Usuarios</a>
																		<ul class="dropdown-menu submenu">
																				<li><a id="users_create" class="dropdown-item" href="{{ route('register') }}">{{ __('Alta de Usuarios') }}</a></li>
																				<li><a id="users_modify" class="dropdown-item" href="{{ asset ('users')  }}">{{ __('Baja y Modificación') }}</a></li>
																		</ul>  

																@endif
																
																@if ( Auth::user()->isAdmin == 1 )

																<a class="dropdown-item dropdown-toggle" href="#">Sectores</a>
																<ul class="dropdown-menu submenu">
																	<li><a class="dropdown-item" href="{{ asset ('sector') }}">{{ __('Alta de Sectores') }}</a></li>
																</ul> 

																<a class="dropdown-item" href="{{ asset ('ticketsAll') }}">{{ __('Total de Tickets') }}</a>
														
															
																@endif

																<a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                              document.getElementById('logout-form').submit();">
                                 {{ __('Deslogueo') }}
                                </a>
                                
																
                                
                                        

                             
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                    


                            </div>
                        </li>
                        
                        
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">
        @yield('content')
    </main>

    
    <footer class="footer">
        <div class="container-fluid px-5">
            <span>Copyrigth 2018</span>
        </div>
    </footer>

    @stack('scripts')
    
    
</body>
</html>

 