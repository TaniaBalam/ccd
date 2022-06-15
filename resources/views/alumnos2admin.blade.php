@extends('layouts.materialize4')

@section('head')
    Alumnos en {{$tallers->taller}} {{$tallers->periodo->periodo}}
@endsection

@section('titulo')
    Alumnos en {{$tallers->taller}} {{$tallers->periodo->periodo}}
@endsection

@section('contenido')


    @if ($alumnos->count() == 0)
        
        <div class="center">
            <p class="white-text">Aún no se han inscrito alumnos en el taller</p>
            <img class="circle" width="250px" height="250px" src="https://i0.wp.com/gatolia.com/wp-content/uploads/2021/04/dibujos-animados-lindo-regreso-escuela-gatos-leyendo-libro_39961-1362.jpg?resize=626%2C450&ssl=1">
        </div>

    @else


    <table class="highlight responsive-table">
            
        <thead class="indigo">
            <th>Nombre</th>
            <th>Correo institucional</th>
            <th>Edad</th> 
            <th>Sexo</th> 
            <th>Teléfono</th>
            <th>Carrera</th>
            <th>Matrícula</th>
            <th>Cultura etnia</th>
            <th>Municipio</th>
            <th>Discapacidad</th>
            
            @can('eliminar alumno')
                <th>Acciones</th>
            @endcan
                            
        </thead>
        
        <tbody class="white">
            @foreach($alumnos as $alumno)
            
                <tr> 
                    <td>{{$alumno->user->name .' '. $alumno->user->last_name}}</td>                                           
                    <td>{{$alumno->user->email}}</td>
                    <td>{{$alumno->edad}}</td>
                    <td>{{$alumno->sexo}}</td>
                    <td>{{$alumno->telefono}}</td>
                    <td>{{$alumno->carrera}}</td>
                    <td>{{$alumno->matricula}}</td>
                    <td>{{$alumno->culturaetnia}}</td>
                    <td>{{$alumno->municipio->municipio}}</td>
                    <td>{{$alumno->discapacidad}}</td>

                    @can('eliminar alumno')
                        <td>  
                            <div>
                                <a style="background:green" class="btn col s12" href="{{route('alumnoadmin.edit',$alumno->id)}}"><i class="material-icons">edit</i></a>
                            </div>
                            <br>

                            <div>
                                <a style="background:red" class=" btn col s12" @click="mensaje({{$alumno->id}},{{$alumno->user->id}})"><i class="material-icons">delete</i></a>
                            </div>
                        </td>
                    @endcan

                </tr>
            @endforeach
                        
        </tbody>
    </table>
    <br>

    @endif
        

@endsection


@section('modal')
    <script>        	
        var app = new Vue({            	
            el: '#app',                
            methods:{
                mensaje(e,e2){
                    Swal.fire({
                        title: '¿Estás seguro que quieres eliminar a este alumno?',
                        showDenyButton: true,
                        confirmButtonText: 'Eliminar',
                        denyButtonText: `Cancelar`,
                        }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            window.location.href = "/alumnos/destroye/alumno="+e+"&user="+e2 
                        }
                    })
                },
            }         
        });        
    </script> 
@endsection