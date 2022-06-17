@extends('layouts.materialize4')

@section('head')
    Talleres
@endsection

@section('titulo')
    Talleres
@endsection

@section('contenido')
    <livewire:crud-taller />
@endsection



@section('modal')

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                confirmButtonText: 'Aceptar!',
                title: "{{session('error')}}",
            })
        </script>
    @endif


    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                confirmButtonText: 'Aceptar!',
                title: "{{session('success')}}",
            })
        </script>
    @endif

    @if(session('actualizar'))
        <script>
            Swal.fire({
                icon: 'success',
                confirmButtonText: 'Aceptar!',
                title: "{{session('actualizar')}}",
            })
        </script>
    @endif

    @if(session('eliminar'))
        <script>
            Swal.fire({
                icon: 'success',
                confirmButtonText: 'Aceptar!',
                title: "{{session('eliminar')}}",
            })
        </script>
    @endif


    <script>
        Livewire.on('SCreate', modal => {
            $(modal).modal('close');
        })
    </script>

    <script>
        Livewire.on('delete', tallerId =>{
            Swal.fire({
                title: '¿Estás seguro que quieres eliminar a este taller?',
                showDenyButton: true,
                confirmButtonText: 'Eliminar',
                denyButtonText: `Cancelar`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Livewire.emitTo('crud-taller','destroye', tallerId);
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

    
@endsection