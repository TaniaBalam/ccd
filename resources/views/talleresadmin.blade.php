@extends('layouts.materialize4')

@section('head')
    Talleres
@endsection

@section('titulo')
    Talleres
@endsection

@section('contenido')


    @can('editar alumno')
        <a style="background:#B8860B" class="btn col s12" href="{{route('creartaller')}}"><i class="material-icons left">add_box</i>Crear taller</a>
    @endcan
    <br><br>

    <table class="highlight responsive-table">
        
        <thead class="indigo">
            <th>Taller</th>
            <th>Descripción</th>
            <th>Maestro</th>
            <th>Horario</th>
            <th>Periodo</th>

            @can('eliminar alumno')
                <th>Acciones</th>
            @endcan
           
            
                            
        </thead>
        
        <tbody class="white">
            @foreach($tallers as $taller)
            
                <tr> 
                    <td>{{$taller->taller}}</td>                                           
                    <td>{{$taller->descripcion}}</td>
                    @if (empty($taller->maestro->user->name))
                        <td>Sin maestro</td>
                    @else
                        <td>{{$taller->maestro->user->name .' '. $taller->maestro->user->last_name}}</td>   
                    @endif

                    <td>{{$taller->horario}}</td>
                    <td>{{$taller->periodo->periodo}}</td>
                   
                    @can('eliminar alumno')
                        <td>  
                            <a style="background:green" class="btn col s12" href="{{route('taller.edit',$taller->id)}}"><i class="material-icons">edit</i></a>
                            <a style="background:red" class="btn col s12" @click="mensaje({{$taller->id}})"><i class="material-icons">delete</i></a>
                        </td>
                    @endcan
                    

                </tr>

            @endforeach
                        
        </tbody>
    </table>
    <br><br>

    {{$tallers->links('vendor.pagination.materializecss')}}

@endsection



@section('modal')
    <script>        	
        var app = new Vue({            	
            el: '#app',                
            methods:{
                mensaje(e){
                    Swal.fire({
                        title: '¿Estás seguro que quieres eliminar este taller?',
                        showDenyButton: true,
                        confirmButtonText: 'Eliminar',
                        denyButtonText: `Cancelar`,
                        }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.href = "/admin/taller/destroye/"+e
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