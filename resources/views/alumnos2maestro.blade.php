@extends('layouts.materialize3')

@section('head')
    Alumnos en {{$tallers->taller}}
@endsection

@section('titulo')
    Alumnos en {{$tallers->taller}}
@endsection

@section('contenido')


    @if ($alumnos->count() == 0)

        <div class="center">
            <p class="white-text">Aún no se han inscrito tus alumnos en el taller</p>
            <img class="circle" width="250px" height="250px" src="https://i0.wp.com/gatolia.com/wp-content/uploads/2021/04/dibujos-animados-lindo-regreso-escuela-gatos-leyendo-libro_39961-1362.jpg?resize=626%2C450&ssl=1">
        </div>
        
    @else

        <table class="highlight responsive-table">
                
            <thead class="indigo">
                <th>Nombre</th>
                <th>Correo institucional</th>
                <th>Carrera</th>
                <th>Matrícula</th>
                <th>Municipio</th>                
            </thead>
            
            <tbody class="white">
                @foreach($alumnos as $alumno)
                
                    <tr> 
                        <td>{{$alumno->user->name .' '. $alumno->user->last_name}}</td>                                           
                        <td>{{$alumno->user->email}}</td>
                        <td>{{$alumno->carrera}}</td>
                        <td>{{$alumno->matricula}}</td>
                        <td>{{$alumno->municipio->municipio}}</td>
                    </tr>
                @endforeach
                            
            </tbody>
        </table>
        <br>

    @endif
        

@endsection