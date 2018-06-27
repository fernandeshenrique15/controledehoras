<html>
	<head>
	    <link href="/css/app.css" rel="stylesheet">
	  <!--  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous"> -->

	    <!-- Icon Google -->
	    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

		<!-- Icon material-design-iconic -->
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css">

    	<link rel="dns-prefetch" href="https://fonts.gstatic.com">
    	<link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
	    <title>Controle de Horas</title>
	</head>
	<body>
        <div class="container">
            <div class="card col-6 mx-auto mt-5 bg-info ">
                <div class="card-body text-white">
                    <p class="card-text lead">Olá {{$work->name}}, você possui {{$work->hours}} horas positivas, já pode tirar uma folga !!</p>
                    <h5 class="card-title text-center">Parabéns!! <i class="zmdi zmdi-coffee"></i></h5>
                    <p class="text-center"><i class="zmdi zmdi-calendar-alt"></i> <strong>Vamos agendar um horário?</strong></p>
                </div>
            </div>
        </div>
    </body>
</html>