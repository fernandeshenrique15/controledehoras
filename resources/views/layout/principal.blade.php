<html>
	<head>
	    <link href="/css/app.css" rel="stylesheet">

	    <!-- Icon Google -->
	    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!-- Icon material-design-iconic -->
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

    	<link rel="dns-prefetch" href="https://fonts.gstatic.com">
    	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
	    <title>Controle de Horas</title>
	</head>
	<body>
		<nav class="navbar navbar-expand-md navbar-dark bg-dark nav-pills nav-fill">
		    <div class="container">

		  <div class="navbar-header">
		    <a class="navbar-brand" href="{{action('RecordController@lista')}}">Controle de Horas</a>
		  </div>

		   <ul class="navbar-nav">
		   	@guest
                  <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a></li>
              @else
                <li class="nav-item">
				    <a class="nav-link {{{ (Request::is('record') ? 'active' : '') }}}" href="{{action('RecordController@lista')}}">
					  	Registros
				    </a>
				  </li>
		        <li class="nav-item"><a href="{{action('WorkController@lista')}}" class="nav-link {{{ (Request::is('work') ? 'active' : '') }}}">Funcionários</a></li>
		        <li class="nav-item"><a href="{{action('DepartmentController@lista')}}" class="nav-link {{{ (Request::is('department') ? 'active' : '') }}}">Departamentos</a></li>
		        <li class="nav-item"><a href="{{action('UserController@lista')}}" class="nav-link {{{ (Request::is('user') ? 'active' : '') }}}">Usuários</a></li>
                  <li class="nav-item dropdown">
                      <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" >
                          {{ Auth::user()->name }} <span class="caret"></span>
                      </a>

                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault();
                                           document.getElementById('logout-form').submit();">
                              {{ __('Sair') }}
                          </a>

                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                          </form>
                      </div>
                  </li>
              @endguest
			</ul>
		  </div>
		</nav>

		<div class="container">
			@if(old('msg'))
				<br><div class="alert alert-{{ old('type')}}">{{ old('msg') }}
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				@if(old('passed'))
					@yield('conteudo')
				@endif
			@else
				@yield('conteudo')
			@endif
		    <footer class="footer mt-5">
		    	<p>© Direitos.</p>
		    </footer>
	  	</div>

	  	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	</body>
</html>
