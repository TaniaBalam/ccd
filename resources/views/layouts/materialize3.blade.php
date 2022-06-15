<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('head')</title>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- CDN materialize icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

      
    <!-- Font awesone -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <!-- SweetAlert2 -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- CDN de chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Alpine v3 -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Montserrat -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap" rel="stylesheet">
    
    <!-- Lato -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">

  
    <style>
        .color{
            background:#1B396A
        }

        .fondo{
            background:#17202A;
        }

        header{
            width:100%;
            height:250px;
            background:url("https://thumbs.dreamstime.com/b/colecci%C3%B3n-de-doodles-deportivos-aislados-en-fondo-blanco-conjunto-deportes-empate-vectores-estilo-doodle-como-f%C3%BAtbol-b%C3%A1dminton-191656401.jpg");
            background:cover;   
            background-attachment: fixed;       
        }

        header .cabecera{
            display:flex;
            height:250px;
            width:100%;
            justify-content: center;
            flex-direction: column;
            text-align: center;            
        }

        .cabecera h3{
            margin-bottom: 30px;
        }
        
        .titulo{
            font-family: 'Montserrat', sans-serif;
        }

        .cuerpo{
            font-family: 'Lato', sans-serif;
        }

        table,td,th{
	        border: 1px solid #17202A;
        }

        .color-base{
            color:#B8860B
        }

        .cambiar:hover{
            background-color:#B8860B
        }

        .btn-flotante {
            font-size: 14px; /* Cambiar el tamaño de la tipografia */
            color: #ffffff; /* Color del texto */
            border-radius: 5px; /* Borde del boton */
            background-color: #008F39; /* Color de fondo */
            padding: 18px 30px; /* Relleno del boton */
            position: fixed;
            bottom: 40px;
            right: 40px;
            transition: all 300ms ease 0ms;
            box-shadow: 0px 8px 15px rgba(0, 0, 0, 0.1);
            z-index: 99;
        }

        .btn-flotante:hover {
            background-color: #2c2fa5; /* Color de fondo al pasar el cursor */
            box-shadow: 0px 15px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-7px);
        }

        @media only screen and (max-width: 600px) {
            .btn-flotante {
                font-size: 12px;
                padding: 12px 20px;
                bottom: 20px;
                right: 20px;
            }
        } 

    </style>
    @livewireStyles


  
</head>
<body class="fondo">

    <ul id="dropdown1" class="dropdown-content fondo">
        <li><a href="{{route('maestro.edit')}}"><i class="material-icons">person_outline</i>Perfil</a></li>
        <li class="divider"></li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <li><a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fa-solid fa-arrow-right-from-bracket"></i>Cerrar sesión</a></li>
        </form>
    </ul>

    <ul id="dropdown2" class="dropdown-content fondo">
        <li><a class="white-text" href="{{route('maestro.edit')}}"><i class="material-icons white-text">person_outline</i>Perfil</a></li>
        <li class="divider"></li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <li><a class="white-text" href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fa-solid fa-arrow-right-from-bracket white-text"></i>Cerrar sesión</a></li>
        </form>
    </ul>

    @php
        $cadena = Auth::user()->email;

        $separador = '@';
        $separada = explode($separador, $cadena);

        $nombre = $separada[0];
    @endphp


    <div class="navbar-fixed cuerpo">
        <nav>
            <div class="nav-wrapper color">
                <div class="container">
                    <a id="logo-container" href="{{route('vistaalumnomaestro')}}" class="brand-logo"><img class="circle" src="https://cdn-ggtech.s3-eu-west-3.amazonaws.com/uploads/users/1600709584428_WhatsApp%20Image%202020-09-16%20at%2019.41.51.jpeg" width="50" height="50"><span>SAE</span></a>
                    <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>            
                </div>
                
                
                <ul class="right hide-on-med-and-down">
                    <li><a href="{{route('vistaalumnomaestro')}}"><i class="fa-solid fa-house left"></i>Inicio</a></li>
                    <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="material-icons left">person_outline</i>{{$nombre}}<i class="material-icons right">arrow_drop_down</i></a></li>
                </ul>

            </div>
        </nav>
    </div>


    <ul class="sidenav fondo cuerpo" id="mobile-demo">
        <li><a class="white-text" href="{{route('vistaalumnomaestro')}}"><i class="fa-solid fa-house left white-text"></i>Inicio</a></li>
        <li><a class="dropdown-trigger white-text" href="#!" data-target="dropdown2"><i class="material-icons left white-text">person_outline</i>{{$nombre}}<i class="material-icons right white-text">arrow_drop_down</i></a></li>
    </ul>


    @yield('bienvenida')
    
    <div id="app">
    
        <div  class="container">
            <h3 class="center white-text titulo">@yield('titulo')</h3>
            <br>
                
            @yield('contenido')

        </div>
        <br></br>

        <footer class="page-footer black cuerpo">
            <div class="footer-copyright black">
                <div class="container">
                    <p class="grey-text text-lighten-4 center">Sistema de Actividades Extraescolares (SAE), &copy;2022, Instituto Tecnológico Superior de Motul</p>
                </div>
            </div>
        </footer>

    </div>


    

</body>
@livewireScripts
    
<script>
    M.AutoInit();
</script>


@yield('modal')


</html>