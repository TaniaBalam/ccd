@extends('layouts.materialize4')

@section('head')
    Periodos
@endsection

@section('titulo')
    Periodos
@endsection

@section('contenido')


    @can('editar alumno')
        <a style="background:#B8860B" class="btn col s12" href="{{route('crearperiodo')}}"><i class="material-icons left">add_box</i>Crear periodo</a>
    @endcan
    <br><br>

    <table class="highlight responsive-table">
        
        <thead class="indigo">
            <th>Periodo</th>
            <th>Fecha de emisión</th>
            <th>Fecha de expiración</th>

            @can('eliminar alumno')
                <th>Acciones</th>
            @endcan
           
            
                            
        </thead>
        
        <tbody class="white">
            @foreach($periodos as $periodo)
            
                <tr> 
                    <td>{{$periodo->periodo}}</td>     
                    <td>{{$periodo->fecha_emision}}</td>
                    <td>{{$periodo->fecha_expiracion}}</td>                                           
        
                    @can('eliminar alumno')
                        <td>  
                            <a style="background:green" class="btn col s12" href="{{route('periodo.edit',$periodo->id)}}"><i class="material-icons">edit</i></a>
                            <a style="background:red" class="btn col s12" @click="mensaje({{$periodo->id}})"><i class="material-icons">delete</i></a>
                        </td>
                    @endcan
                    

                </tr>

            @endforeach
                        
        </tbody>
    </table>
    <br><br>

    {{$periodos->links('vendor.pagination.materializecss')}}

@endsection


@section('modal')
    <script>        	
        var app = new Vue({            	
            el: '#app',                
            methods:{
                mensaje(e){
                    Swal.fire({
                        title: '¿Estás seguro que quieres eliminar este periodo escolar?',
                        showDenyButton: true,
                        confirmButtonText: 'Eliminar',
                        denyButtonText: `Cancelar`,
                        }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.href = "/admin/periodo/destroye/"+e
                        }
                    })
                },
            }         
        });        
    </script> 

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                confirmButtonText: 'Aceptar!',
                title: "{{session('error')}}",
            })
        </script>
    @endif
    
@endsection