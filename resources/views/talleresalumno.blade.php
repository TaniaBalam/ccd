@extends('layouts.materialize2')

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
                <b><span style="font-size:xx-large; background:white" class="titulo">¡Hola, buenos días {{$Alumno->user->name .' '. $Alumno->user->last_name}}!</span></b>    

            @elseif (date('H') >= 12 && date('H') <= 18)
                <b><span style="font-size:xx-large; background:white" class="titulo">¡Hola, buenas tardes {{$Alumno->user->name .' '. $Alumno->user->last_name}}!</span></b>    
            

            @elseif (date('H')>= 18 && date('H')<= 24)
                <b><span style="font-size:xx-large; background:white" class="titulo">¡Hola, buenas noches {{$Alumno->user->name .' '. $Alumno->user->last_name}}!</span></b>    
            @endif
        </section>
    </header>
    
@endsection

@section('contenido')

    <livewire:talleres-alumno/>
   
@endsection


@section('modal')

    <script>
        Livewire.on('inscripcion', tallerId =>{
            Swal.fire({
                title: '¿Estás seguro que quieres inscribirte a este taller? Una vez inscrito no podrás cambiarlo.',
                showDenyButton: true,
                confirmButtonText: 'Incribirme',
                denyButtonText: `Cancelar`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Livewire.emitTo('talleres-alumno','inscribirse', tallerId);
                }
            })
        })
    </script>

    <script>
        Livewire.on('mensaje', (mensaje, icono) => {
            Swal.fire({
                title: mensaje,
                icon: icono,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Aceptar'
            })
        })
    </script>

    <script>
        Livewire.on('SCreate', modal => {
            $(modal).modal('close');
        })
    </script>


@endsection



