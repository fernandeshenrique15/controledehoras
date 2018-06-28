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
        <div class="container">
            <div class="card col-6 mx-auto mt-5 bg-info ">
                <div class="card-body text-white">
                    <p class="card-text lead">Olá {{$name}}, você possui {{$hours}} horas negativas !!</p>
                    <p class="text-center"><i class="zmdi zmdi-calendar-alt"></i> <strong>Você gostaria de fazer hora extra ou descontar em folha?</strong></p>
                </div>
            </div>
        </div>
    </body>
</html>