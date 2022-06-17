@extends('layouts.materialize4')

@section('head')
    Periodos
@endsection

@section('titulo')
    Periodos
@endsection

@section('contenido')

    <livewire:crud-periodo />

@endsection


@section('modal')
 
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
                    Livewire.emitTo('crud-periodo','destroye', tallerId);
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