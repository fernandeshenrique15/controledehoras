<html>
	<head>
	    <!-- <link href="/css/app.css" rel="stylesheet"> -->
	    <link href="/css/custom.css" rel="stylesheet">
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	        <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
	    <title>Controle de Horas</title>
	</head>
	<body>
	  <div class="container">

		  <nav class="navbar navbar-default">
		    <div class="container-fluid">

		    <div class="navbar-header">
		      <a class="navbar-brand" href="{{action('RecordController@lista')}}">Controle de Horas</a>
		    </div>

		     <ul class="nav navbar-nav navbar-right">
		     	@guest
                    <li><a class="nav-link" href="{{ route('login') }}">{{ __('Entrar') }}</a></li>
                @else
                  <li class="nav-item">
				      <a class="nav-link" href="{{action('RecordController@lista')}}">
				          Registros
				      </a>
				  </li>
		          <li><a href="{{action('WorkController@lista')}}">Funcionários</a></li>
		          <li><a href="{{action('DepartmentController@lista')}}">Departamentos</a></li>
		          <li><a href="{{action('UserController@lista')}}">Administradores</a></li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
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
			@if(old('msg'))
				<br><div class="alert alert-{{ old('type')}}">{{ old('msg') }}</div>
				@if(old('passed'))
					@yield('conteudo')
				@endif
			@else
				@yield('conteudo')
			@endif
		  <footer class="footer">
		      <p>© Direitos.</p>
		  </footer>

	  </div>
	</body>
</html>
