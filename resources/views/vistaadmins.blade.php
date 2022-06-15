@extends('layouts.materialize4')

@section('head')
    Administradores
@endsection

@section('titulo')
    Administradores
@endsection

@section('contenido')

    
    <livewire:crud-admin />

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

    <script>
        Livewire.on('SCreate', modal => {
            $(modal).modal('close');
        })
    </script>

    <script>
        Livewire.on('delete', (userId, adminId) =>{
            Swal.fire({
                title: '¿Estás seguro que quieres eliminar a este administrador?',
                showDenyButton: true,
                confirmButtonText: 'Eliminar',
                denyButtonText: `Cancelar`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Livewire.emitTo('crud-admin','destroye', userId, adminId);
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