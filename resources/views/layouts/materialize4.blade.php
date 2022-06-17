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


        table,td,th{
	        border: 1px solid #17202A;
        }

        .largo{
            height:60px;
            width:100%;
            max-width:100%;
            min-width:100%;
            max-height:500px;
            min-height:60px;
        }

        .btn:hover{
            background-color:#B8860B
        }

        .color-base{
            color:#B8860B
        }

        .cambiar:hover{
            color:#1B396A
        }

        .titulo{
            font-family: 'Montserrat', sans-serif;
        }

        .cuerpo{
            font-family: 'Lato', sans-serif;
        }


                
    </style>
    @livewireStyles


  
</head>
<body class="fondo">

    <ul id="dropdown1" class="dropdown-content fondo">
        <li><a href="{{route('admin.edit')}}"><i class="material-icons">person_outline</i>Perfil</a></li>
        <li class="divider"></li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <li><a href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fa-solid fa-arrow-right-from-bracket"></i>Cerrar sesión</a></li>
        </form>
    </ul>

    <ul id="dropdown2" class="dropdown-content fondo">
        <li><a class="white-text" href="{{route('admin.edit')}}"><i class="material-icons white-text">person_outline</i>Perfil</a></li>
        <li class="divider"></li>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <li><a class="white-text" href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();"><i class="fa-solid fa-arrow-right-from-bracket white-text"></i>Cerrar sesión</a></li>
        </form>
    </ul>

    <ul id="dropdown3" class="dropdown-content fondo">
        <li><a href="{{route('vistaalumnoadmin')}}"><i class="material-icons left">school</i>Alumnos / asistencias</a></li>
        <li class="divider"></li>
        <li><a href="{{route('vistamaestroadmin')}}"><i class="material-icons left">group</i>Maestros</a></li>
        <li class="divider"></li>
        <li><a href="{{route('vistatalleradmin')}}"><i class="material-icons left">loyalty</i>Talleres</a></li>
        <li class="divider"></li>
        <li><a href="{{route('vistaperiodos')}}"><i class="material-icons left">date_range</i>Periodos</a></li>
        <li class="divider"></li>
        @can('editar alumno')
            <li><a href="{{route('vistaadmins')}}"><i class="material-icons left">group</i>Admins</a></li> 
        @endcan
    </ul>

    <ul id="dropdown4" class="dropdown-content fondo">
        <li><a class="white-text" href="{{route('vistaalumnoadmin')}}"><i class="material-icons left white-text">school</i>Alumnos / asistencias</a></li>
        <li class="divider"></li>
        <li><a class="white-text" href="{{route('vistamaestroadmin')}}"><i class="material-icons left white-text">group</i>Maestros</a></li>
        <li class="divider"></li>
        <li><a class="white-text" href="{{route('vistatalleradmin')}}"><i class="material-icons left white-text">loyalty</i>Talleres</a></li>
        <li class="divider"></li>
        <li><a class="white-text" href="{{route('vistaperiodos')}}"><i class="material-icons left white-text">date_range</i>Periodos</a></li>
        <li class="divider"></li>
        @can('editar alumno')
            <li><a class="white-text" href="{{route('vistaadmins')}}"><i class="material-icons left white-text">group</i>Admins</a></li>
        @endcan
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
                <a id="logo-container" href="{{route('admininicio')}}" class="brand-logo"><img class="circle" src="https://cdn-ggtech.s3-eu-west-3.amazonaws.com/uploads/users/1600709584428_WhatsApp%20Image%202020-09-16%20at%2019.41.51.jpeg" width="50" height="50"><span>SAE</span></a>
                <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>            
            </div>
            
            
            <ul class="right hide-on-med-and-down">
                <li><a href="{{route('admininicio')}}"><i class="fa-solid fa-house left"></i>Inicio</a></li> 
                <li><a class="dropdown-trigger" href="#!" data-target="dropdown3"><i class="material-icons left">storage</i>Gestionar<i class="material-icons right">arrow_drop_down</i></a></li>
                <li><a class="dropdown-trigger" href="#!" data-target="dropdown1"><i class="material-icons left">person_outline</i>{{$nombre}}<i class="material-icons right">arrow_drop_down</i></a></li>
            </ul>

            </div>
        </nav>
            

    </div>


    <ul class="sidenav fondo cuerpo" id="mobile-demo">
        <li><a class="white-text" href="{{route('admininicio')}}"><i class="fa-solid fa-house left white-text"></i>Inicio</a></li>
        <li><a class="dropdown-trigger white-text" href="#!" data-target="dropdown4"><i class="material-icons left white-text">storage</i>Gestionar<i class="material-icons right white-text">arrow_drop_down</i></a></li>
        <li><a class="dropdown-trigger white-text" href="#!" data-target="dropdown2"><i class="material-icons left white-text">person_outline</i>{{$nombre}}<i class="material-icons right white-text">arrow_drop_down</i></a></li>
    </ul>



    @yield('bienvenida')

    <div>
    
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

@yield('graficas')


</html>