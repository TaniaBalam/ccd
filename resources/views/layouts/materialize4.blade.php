<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('head')</title>

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

    <!-- Vue -->
    <script src="https://cdn.jsdelivr.net/npm/vue@2.5.16/dist/vue.js"></script>

    <!-- CDN de chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

  
    <style>
        .color{
            background:#1B396A
        }

        .fondo{
            background:#17202A;
        }

        table,td,th{
	        border: 1px solid black;
        }

        .m{
            background:pink;
        }

    </style>


  
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


    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper color">
            <div class="container">
                <a id="logo-container" href="{{route('admininicio')}}" class="brand-logo"><img class="circle" src="https://cdn-ggtech.s3-eu-west-3.amazonaws.com/uploads/users/1600709584428_WhatsApp%20Image%202020-09-16%20at%2019.41.51.jpeg" width="50" height="50"><span>CCD</span></a>
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


    <ul class="sidenav fondo" id="mobile-demo">
        <li><a class="white-text" href="{{route('admininicio')}}"><i class="fa-solid fa-house left white-text"></i>Inicio</a></li>
        <li><a class="dropdown-trigger white-text" href="#!" data-target="dropdown4"><i class="material-icons left white-text">storage</i>Gestionar<i class="material-icons right white-text">arrow_drop_down</i></a></li>
        <li><a class="dropdown-trigger white-text" href="#!" data-target="dropdown2"><i class="material-icons left white-text">person_outline</i>{{$nombre}}<i class="material-icons right white-text">arrow_drop_down</i></a></li>
    </ul>



    <div id="app">
    
        <div  class="container">
            <h3 class="center white-text">@yield('titulo')</h3>
            <br>
                
            @yield('contenido')

        </div>

    </div>
    

</body>

    
<script>
    M.AutoInit();
</script>


@yield('modal')

@yield('graficas')


</html>