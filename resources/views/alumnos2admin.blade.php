@extends('layouts.materialize4')

@section('head')
    Alumnos en {{Str::lower($tallers->taller)}} {{$tallers->periodo->periodo}}
@endsection

@section('titulo')
    Alumnos en {{Str::lower($tallers->taller)}} {{$tallers->periodo->periodo}}
@endsection

@section('contenido')


    @if ($alumnos->count() == 0)
        
        <div class="center">
            <p class="white-text">Aún no se han inscrito alumnos en el taller</p>
            <img class="circle" width="250px" height="250px" src="https://i0.wp.com/gatolia.com/wp-content/uploads/2021/04/dibujos-animados-lindo-regreso-escuela-gatos-leyendo-libro_39961-1362.jpg?resize=626%2C450&ssl=1">
        </div>

    @else
     
        @livewire('crud-alumno', ['idtaller' => $idtaller])
        <br></br>

    @endif
        

@endsection


@section('modal')
    <script>
        Livewire.on('SCreate', modal => {
            $(modal).modal('close');
        })
    </script>

    <script>
        Livewire.on('delete', (userId, alumnoId) =>{
            Swal.fire({
                title: '¿Estás seguro que quieres eliminar a este alumno?',
                showDenyButton: true,
                confirmButtonText: 'Eliminar',
                denyButtonText: `Cancelar`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Livewire.emitTo('crud-alumno','destroye', userId, alumnoId);
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

    <!-- mensaje para registro -->
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            confirmButtonText: 'Aceptar!',
            title: "{{session('success')}}",
        })
    </script>
    @endif
@endsection