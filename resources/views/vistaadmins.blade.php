@extends('layouts.materialize4')

@section('head')
    Administradores
@endsection

@section('titulo')
    Administradores
@endsection

@section('contenido')


    
    <a style="background:#B8860B" class="btn col s12" href="{{route('crearadmin')}}"><i class="material-icons left">person_add</i>Crear administrador</a>
    
    <br><br>

    <table class="highlight responsive-table">
        
        <thead class="indigo">
            <th>Nombre</th>
            <th>Correo institucional</th>
            <th>Acciones</th>
                             
        </thead>
        
        <tbody class="white">
            @foreach($admins as $admin)
            
                <tr> 
                    <td>{{$admin->user->name}} {{$admin->user->last_name}}</td>                                           
                    <td>{{$admin->user->email}}</td>   
                   
                    <td>  
                        <a style="background:green" class="btn col s12" href="{{route('admin.edit2',$admin->id)}}"><i class="material-icons">edit</i></a>
                        <a style="background:red" class="btn col s12" @click="mensaje({{$admin->id}},{{$admin->user->id}})"><i class="material-icons">delete</i></a>
                    </td>
                   
                    
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
                        title: '¿Estás seguro que quieres eliminar a este administrador?',
                        showDenyButton: true,
                        confirmButtonText: 'Eliminar',
                        denyButtonText: `Cancelar`,
                        }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.href = "/admin/destroye/admin="+e+"&user="+e2 
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