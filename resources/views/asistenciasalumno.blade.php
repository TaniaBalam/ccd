@extends('layouts.materialize2')

@section('head')
    Asistencias
@endsection

@section('titulo')
    @if(empty($alumno->taller_id))
        Asistencias 
    @else
        Asistencias del taller {{$alumno->taller->taller}}
    @endif
@endsection

@section('contenido')

    @if(empty($alumno->taller_id))

        <div class="center cuerpo">
            <p class="white-text">Vaya parece que no te has inscrito a ningún taller</p>
            <p class="white-text">Inscríbete para poder empezar a recibir asistencias</p>
            <img class="circle" width="250px" height="250px" src="https://img.freepik.com/vector-gratis/dibujos-animados-lindo-regreso-escuela-gato-libro_39961-1299.jpg">
        </div>

    @else

        @if ($alumno->asistencias->count()==0)
            <div class="center cuerpo">
                <p class="white-text">Por ahora, no tienes asistencias aplicadas</p>
                <p class="white-text">Vuelve más tarde para ver si hay asistencias nuevas</p>
                
                <img class="circle" width="250px" height="250px" src="https://img.freepik.com/vector-gratis/dibujos-animados-lindo-regreso-escuela-gato-aula_39961-1328.jpg?w=2000">
            </div>
        @else


            <div class="center">
                @if (now()->toDateString()>=$alumno->taller->periodo->fecha_expiracion && $asistencias2>=$f)
                    <p class="green-text cuerpo">¡Yuju! ya puedes descargar tu acreditación del taller ¡Enhorabuena!</p>
                    <div class="cuerpo">
                        <a href="{{route('acreditacion')}}" class="waves-effect waves-light btn-small green">Descargar acreditación<i class="material-icons right">file_download</i></a>
                    </div>
                @else
                    <p class="green-text cuerpo">Podrás descargar tu acreditación cuando el periodo acabe y tengas al menos el 70% de tus asistencias</p>
                    <div class="cuerpo">
                        <a href="{{route('acreditacion')}}" disabled class="waves-effect waves-light btn-small">Descargar acreditación<i class="material-icons right">file_download</i></a>
                    </div>
                @endif
            </div> 

            <br>


            <div class="row">

                <div class="col s12 m6">
                    <p class="white-text cuerpo">Porcentaje de asistencia: {{$porcasis}}%</p>
                    

                    <table class="highlight responsive-table titulo">
                            
                        <thead class="indigo">
                            <th>Fecha</th>
                            <th>Asistencia</th>
                                
                        </thead>
                            
                            <tbody class="white">
                                @foreach($asistenciasalum as $asistencia)
                                
                                    <tr> 
                                        <td>{{$asistencia->fecha}}</td> 
                                        @if ($asistencia->af ==1)                                      
                                            <td><i class="material-icons green-text">check</i></td>
                                        @else
                                            <td><i class="material-icons red-text">close</i></td>
                                        @endif
                                    </tr>
                    
                                @endforeach            
                            </tbody>
                    </table>
                    <br>

                </div>

                <div class="col s12 m6">
                    <br><br>
                    <div class="card white">
                        <canvas style="max-width:700px;max-height:300px;"  id="asis" ></canvas>
                    </div>
                </div>

            </div>


            
        @endif

    @endif

@endsection



@section('graficas')

<script>
    
    var xValues = ["Asistencias","Faltas"];
    var yValues = [{{Js::from($asistencias2)}},{{Js::from($asistencias3)}}];
    var barColors = ["green", "red"];
    new Chart(document.getElementById("asis"), {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
       
    });
</script>

@endsection