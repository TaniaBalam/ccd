@extends('layouts.materialize3')

@section('head')
    Actualiza tu perfil
@endsection

@section('titulo')
    Actualiza tu perfil
@endsection

@section('contenido')

    <livewire:perfil-maestro/>

@endsection


@section('modal')

    <script>
        Livewire.on('SCreate', modal => {
            $(modal).modal('close');
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
                Livewire.emitTo('perfil-maestro','cargar');
        })
    </script>
@endsection