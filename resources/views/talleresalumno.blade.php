@extends('layouts.materialize2')

@section('head')
    Talleres
@endsection

@section('titulo')
    Coordinación de Cultura y Deporte
@endsection



@section('bienvenida')
    <header>
        <section class="cabecera">
            <b><span style="font-size:xx-large" class="color white-text titulo">¡Hola bienvenido(a) {{$Alumno->user->name .' '. $Alumno->user->last_name}}!</span></b>    
        </section>
    </header>
    
@endsection

@section('contenido')


    @if(empty($Alumno->taller_id))

        <h5 class="white-text center cuerpo">Inscríbete a uno de los siguientes talleres</h5>

        <p class="white-text center cuerpo">Si no te gustan los deportes no te preocupes, puedes inscribirte a los talleres culturales</p>

        <div class="row">


        @foreach($tallers as $taller)
            <div class="col s12 m6">

                <div class="card medium sticky-action">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="{{$taller->imagen}}" height="200px">
                    </div>

                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"><b>{{$taller->taller}} {{$taller->periodo->periodo}}</b><i class="material-icons right">more_vert</i></span>
                        <p>Descripción: {{ Str::limit ($taller->descripcion, 90)}}</p>
                    </div>

                    <div class="card-action center">
                        <form id="formulario{{$taller->id}}" action="{{route('inscripcionalumno',$Alumno->id)}}" method="POST">
                            @csrf
                            @method('put')
                            <input  value="{{$taller->id}}" name="taller" id="taller" type="hidden" >
                            <a style="background:#1B396A" class="waves-effect waves-light btn"  @click="mensaje({{$taller->id}})" >¡Inscribirse! <i class="material-icons">create</i></a>
                        </form>
                    </div>

                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4"><b>{{$taller->taller}} {{$taller->periodo->periodo}}</b><i class="material-icons right">close</i></span>
                        <p>Descripción: {{$taller->descripcion}}</p>
                        <p>Horario: {{$taller->horario}}</p>
                        
                        @if (empty($taller->maestro->user->name))
                            <p> Maestro: Sin maestro</p>
                        @else
                            <p>Maestro: {{$taller->maestro->user->name .' '. $taller->maestro->user->last_name}}</p>   
                        @endif
                            
                                
                            
                    </div>
                    
                </div>

            </div>

            

                
            
        @endforeach

        </div>

    @else

        <p class="white-text center cuerpo">Este es el taller al que te inscribiste</p>

        <div class="row">
            <div class="col s12 m6">

                <div class="card medium sticky-action">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="{{$Alumno->taller->imagen}}" height="200px">
                    </div>

                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"><b>{{$Alumno->taller->taller}} {{$Alumno->taller->periodo->periodo}}</b><i class="material-icons right">more_vert</i></span>
                        <p>Descripción: {{ Str::limit ($Alumno->taller->descripcion, 90)}}</p>
                    </div>

                    <div class="card-action center">
                        <a style="color:#B8860B" href="{{route('asistenciaalumno')}}"><i class="material-icons">assignment_turned_in</i>Asistencias</a>
                    </div>

                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4"><b>{{$Alumno->taller->taller}} {{$Alumno->taller->periodo->periodo}}</b><i class="material-icons right">close</i></span>
                        <p>Descripción: {{$Alumno->taller->descripcion}}</p>
                        <p>Horario: {{$Alumno->taller->horario}}</p>
                        
                        @if (empty($Alumno->taller->user->name))
                            <p> Maestro: Sin maestro</p>
                        @else
                            <p>Maestro: {{$Alumno->taller->maestro->user->name .' '. $Alumno->taller->maestro->user->last_name}}</p>   
                        @endif
                            
                                
                            
                    </div>
                    
                </div>

            </div>

        </div>
        <br><br>
        <br><br>

        @if (now()->toDateString()>=$Alumno->taller->periodo->fecha_expiracion)
            <a href="" class="btn-flotante">El periodo acabó al fin puedes ir a <br> revisar tu documento de acreditación</a>
        @else
            <a href="" class="btn-flotante">¡Faltan {{$diasDiferencia}} días para que acabe el periodo y puedas <br> descargar tu acreditación!</a>
        @endif

    @endif
        

   
@endsection


@section('modal')


          	
<script>        	
    var app = new Vue({            	
        el: '#app',                
        methods:{
            mensaje(e){
                event.preventDefault();
                Swal.fire({
                    title: '¿Estás seguro que quieres inscribirte a este taller? Una vez inscrito no podrás cambiarlo.',
                    showDenyButton: true,
                    confirmButtonText: 'Incribirme',
                    denyButtonText: `Cancelar`,
                    }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                        document.getElementById("formulario"+e).submit();   
                    }
                })
            },
        }         
    });        
</script> 

<!-- mensaje para registro -->
@if(session('registro'))
<script>
    Swal.fire({
        icon: 'success',
        confirmButtonText: 'Aceptar!',
        title: "{{session('registro')}}",
    })
</script>
@endif


@endsection



