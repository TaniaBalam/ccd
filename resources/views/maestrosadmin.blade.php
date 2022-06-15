@extends('layouts.materialize4')

@section('head')
    Maestros
@endsection

@section('titulo')
    Maestros
@endsection

@section('contenido')

    <livewire:crud-maestro />

    <br><br>
@endsection


@section('modal')
    <!--  
    <script>        	
        var app = new Vue({            	
            el: '#app',                
            methods:{
                mensaje(e,e2){
                    Swal.fire({
                        title: '¿Estás seguro que quieres eliminar a este maestro?',
                        showDenyButton: true,
                        confirmButtonText: 'Eliminar',
                        denyButtonText: `Cancelar`,
                        }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.href = "/maestro/destroye/maestro="+e+"&user="+e2 
                        }
                    })
                },
            }         
        });        
    </script> -->

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
        Livewire.on('delete', (userId, maestroId) =>{
            Swal.fire({
                title: '¿Estás seguro que quieres eliminar a este maestro?',
                showDenyButton: true,
                confirmButtonText: 'Eliminar',
                denyButtonText: `Cancelar`,
                }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    Livewire.emitTo('crud-maestro','destroye', userId, maestroId);
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