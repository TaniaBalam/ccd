@extends('layouts.materialize3')

@section('head')
    Asistencias
@endsection

@section('titulo')
    Asistencias
@endsection

@section('contenido')

    @if ($alumnos->count() == 0)

        <div class="center">
            <p class="white-text">Aún no se han inscrito tus alumnos en el taller</p>
            <img class="circle" width="250px" height="250px" src="https://i0.wp.com/gatolia.com/wp-content/uploads/2021/04/dibujos-animados-lindo-regreso-escuela-gatos-leyendo-libro_39961-1362.jpg?resize=626%2C450&ssl=1">
        </div>
        
    @else

    <form method="POST" action="/maestro/asistencias/store">
        @csrf

        <a  style="background:#B8860B" href="{{route('editasistenciasmaestro', $id)}}" class="waves-effect waves-light btn-small ">Editar asistencias<i class="material-icons left">edit</i></a>
        <br><br>
        
        <div class="row">
            <div class="col s4">
                <span class="white-text">Fecha:</span>
                <input name="fecha" id="fecha" type="date" class="@error('fecha') is-invalid @enderror grey lighten-2" value="{{old('fecha')}}">
                @error('fecha')
                    <span class="alert alert-danger red-text">{{$message}}</span>
                @enderror()
            </div>
        </div>

        <div>
            <!-- mensaje para error de fecha -->
            @if(session('error'))
                <span class="red-text">{{session('error')}}</span>
            @endif
        </div>
        <br>

        <div class="right">
            <button style="background:#B8860B" class="waves-effect waves-light btn-small">Guardar asistencias<i class="material-icons left">save</i></button>  
        </div>
        <br><br>

        <input name="taller" id="taller" type="hidden" value="{{$tallers->id}}">
        
        
        <input style="background:green" class="waves-effect waves-light" type="button" id="BtnSeleccionar" value="Marcar todos">
        <input style="background:red" class="waves-effect waves-light" type="button" id="BtnDeseleccionar" value="Desmarcar todos">
        <br><br>
        

        <table class="highlight responsive-table">
                
            <thead class="indigo">
                <th>Matrícula</th>
                <th>Alumno</th>  
                <th>Asistencia</th>

            </thead>
            
            <tbody class="white">
                @foreach($alumnos as $alumno)

                    <input name="alumnoid[]" id="alumnoid[]" type="hidden" value="{{$alumno->id}}">
                    <input name="tallerid[]" id="tallerid[]" type="hidden" value="{{$alumno->taller_id}}">
                
                    <tr> 
                        <td>{{$alumno->matricula}}</td>
                        <td>{{$alumno->user->name .' '. $alumno->user->last_name}}</td>
                        <td>
                            <select  class="browser-default" id="seleccionar" name="asistencia[]">
                                <option value="2">Falta</option>
                                <option value="1">Asistencia</option>
                            </select>
                        </td>                                           
                    </tr>
                @endforeach
                            
            </tbody>
        </table>
        <br>
 
    </form>

    @endif

@endsection



@section('modal')

<!--<script>
    $(document).ready(function() {
        $('#BtnSeleccionar').click(function() {
            $('#asis input[type=checkbox]').prop("checked", true);
        });

        $('#BtnDeseleccionar').click(function() {
            $('#asis input[type=checkbox]').prop("checked", false);
        });
    });
</script>-->

<script>
    $(document).ready(function() {
        $('#BtnSeleccionar').click(function() {
            $('select[id="seleccionar"]').val('1');
        });

        $('#BtnDeseleccionar').click(function() {
            $('select[id="seleccionar"]').val('2');
        });

    });
</script>


<!-- mensaje de guardado de asistencia -->
@if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            confirmButtonText: 'Aceptar!',
            title: "{{session('success')}}",
        })
    </script>
@endif

@endsection
