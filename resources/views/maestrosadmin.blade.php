@extends('layouts.materialize4')

@section('head')
    Maestros
@endsection

@section('titulo')
    Maestros
@endsection

@section('contenido')


    @can('editar alumno')
        <a style="background:#B8860B" class="btn col s12" href="{{route('crearmaestroadmin')}}"><i class="material-icons left">person_add</i>Crear maestro</a>
    @endcan
    <br><br>

    <table class="highlight responsive-table">
            
        <thead class="indigo">
            <th>Nombre</th>
            <th>Correo institucional</th>
            <th>Número de maestro</th>

            @can('eliminar alumno')
                <th>Acciones</th>
            @endcan
            
                            
        </thead>
        
        <tbody class="white">
            @foreach($maestros as $maestro)
            
                <tr> 
                    <td>{{$maestro->user->name .' '. $maestro->user->last_name}}</td>                                           
                    <td>{{$maestro->user->email}}</td>
                    <td>{{$maestro->numero}}</td>

                    @can('eliminar alumno')
                        <td>  
                            <a style="background:green" class="btn col s12" href="{{route('maestro2.edit',$maestro->id)}}"><i class="material-icons">edit</i></a>
                            <a style="background:red" class="btn col s12" @click="mensaje({{$maestro->id}},{{$maestro->user->id}})"><i class="material-icons">delete</i></a>
                        </td>
                    @endcan

                </tr>

            @endforeach
                        
        </tbody>
    </table>
    <br><br>

@endsection


@section('modal')
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