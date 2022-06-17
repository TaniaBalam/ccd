@extends('layouts.materialize3')

@section('head')
    Talleres
@endsection

@section('titulo')
    Talleres
@endsection


@section('bienvenida')
    
    <header>
        <section class="cabecera">
            @if (date('H')< 12)
                <b><span style="font-size:xx-large; background:white" class="titulo">¡Hola, buenos días {{Auth::user()->name.' '.Auth::user()->last_name}}!</span></b>    

            @elseif (date('H') >= 12 && date('H') <= 18)
                <b><span style="font-size:xx-large; background:white" class="titulo">¡Hola, buenas tardes {{Auth::user()->name.' '.Auth::user()->last_name}}!</span></b>    
            

            @elseif (date('H')>= 18 && date('H')<= 24)
                <b><span style="font-size:xx-large; background:white" class="titulo">¡Hola, buenas noches {{Auth::user()->name.' '.Auth::user()->last_name}}!</span></b>    
            @endif
        </section>
    </header>
    
@endsection

@section('contenido')

    
    @if ($tallers->count()==0)

        <div class="center">
            <p class="white-text cuerpo">No tiene talleres asignados en este periodo</p>
            <img class="circle" width="250px" height="250px" src="https://img.freepik.com/vector-gratis/dibujos-animados-lindo-regreso-escuela-gatos-clase_39961-1282.jpg">
        </div>
        
    @else

    <p class="center white-text cuerpo">Estos son los talleres que imparte</p>

    <div class="row">
        @foreach($tallers as $taller)
            <div class="col s12 m6">
                <div class="card sticky-action" style="height=250px">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="{{$taller->imagen}}" height="200px">
                    </div>

                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"><b>{{$taller->taller}} {{$taller->periodo->periodo}}</b><i class="material-icons right">more_vert</i></span>
                        <p>Número de alumnos: {{$taller->alumnos->count()}}</p>
                        <p>Horario: {{ Str::limit ($taller->horario, 25)}}</p>
                        
                    </div>

                    <div class="card-action center">
                        
                        <a style="color:#B8860B" href="{{route('vistaveralumnosmaestro', $taller->id)}}"><i class="material-icons">group</i>Alumnos</a>
                        <a style="color:#B8860B" href="{{route('asistenciasmaestro', $taller->id)}}"><i class="material-icons">assignment_turned_in</i>Asistencias</a>
                        <br><br>
                        <a style="color:#B8860B" href="{{route('repoasistenciasmaestro', $taller->id)}}"><i class="material-icons">event_note</i>Reporte de asistencias</a>
                          
                    </div>

                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4"><b>{{$taller->taller}} {{$taller->periodo->periodo}}</b><i class="material-icons right">close</i></span>
                        <p>Número de alumnos: {{$taller->alumnos->count()}}</p>
                        <p>Horario: {{$taller->horario}}</p>                              
                    </div>  
                </div>
            </div>
        @endforeach
    </div>


    <a href="" class="btn-flotante">Es hora de poner asistencias <img src="https://acegif.com/wp-content/uploads/cat-typing-1.gif" width="50px" height="50px"> </a>


    @endif

@endsection