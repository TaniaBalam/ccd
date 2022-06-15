@extends('layouts.materialize4')

@section('head')
    Reporte de asistencias
@endsection

@section('titulo')
    Reporte de asistencias
@endsection

@section('contenido')


    @if ($alumnos->count() == 0)
    
        <div class="center">
            <p class="white-text">Aún no se han inscrito alumnos en el taller</p>
            <img class="circle" width="250px" height="250px" src="https://i0.wp.com/gatolia.com/wp-content/uploads/2021/04/dibujos-animados-lindo-regreso-escuela-gatos-leyendo-libro_39961-1362.jpg?resize=626%2C450&ssl=1">
        </div>


    @else

        <p class="white-text">No. de asistencias: {{$asistencias}}</p>

        <table class="highlight responsive-table">
                
            <thead class="indigo">
                <th>Matrícula</th>
                <th>Alumno</th>
                <th>Asistencias</th>
                <th>Faltas</th>
                <th>Porcentaje de asistencia</th>
                <th>Derecho a acreditación</th>
                    
            </thead>
                
                <tbody class="white">
                    @foreach($alumnos as $alumno)
                        <tr> 
                            <td>{{$alumno->matricula}}</td>
                            <td>{{$alumno->user->name}} {{$alumno->user->last_name}}</td> 
                            <td>{{$alumno->asistencias->where('af','=', 1)->count()}}</td> 
                            <td>{{$alumno->asistencias->where('af','=', 2)->count()}}</td> 

                            @if($alumno->asistencias->count()>=1)
                                <td>{{($alumno->asistencias->where('af','=', 1)->count()*100)/$asistencias}}%</td>
                            @else
                                <td>0%</td>  
                            @endif

                             
                            @if($alumno->asistencias->where('af','=', 1)->count()>=$f && $alumno->asistencias->count()>=1)
                                <td><i class="material-icons green-text">check</i></td>
                            @else
                                <td><i class="material-icons red-text">close</i></td> 
                            @endif

                        </tr>
                    @endforeach            
                </tbody>
        </table>
        <br>

    @endif


@endsection