@extends('layouts.materialize3')

@section('head')
    Asistencias
@endsection

@section('titulo')
    Asistencias {{Str::lower($tallers->taller)}} {{$tallers->periodo->periodo}}
@endsection

@section('contenido')


    @if ($asistencias->count()==0)
        
        <div class="center">
            <p class="white-text cuerpo">No tiene asistencias aplicadas en este taller</p>
            <img class="circle" width="250px" height="250px" src="https://media.istockphoto.com/vectors/cartoon-cute-back-to-school-teacher-cat-writing-paper-vector-vector-id1165676177">
        </div>

    @else

        <form method="POST" action="{{route('asis.update')}}">
            @csrf
            @method('put')

            <table class="highlight responsive-table titulo">
                    
                    <thead class="indigo">
                        <th>Matrícula</th>
                        <th>Alumno</th>
                        <th>Fecha</th>
                        <th>Asistencia</th>
                            
                    </thead>
                        
                    <tbody class="white">
                        @foreach($asistencias as $asistencia)
                        
                            <tr> 
                                <td>{{$asistencia->alumno->matricula}}</td>
                                <td>{{$asistencia->alumno->user->name}} {{$asistencia->alumno->user->last_name}}</td>
                                <td>{{$asistencia->fecha}}</td> 
                                <td>
                                    <select  class="browser-default" id="seleccionar" name="asistencia[]">
                                        <option value="2" @if($asistencia->af == 2) selected  @endif   {{ old('asistencia') == 1 ? 'selected' : '' }}>Falta</option>
                                        <option value="1" @if($asistencia->af == 1) selected  @endif   {{ old('asistencia') == 1 ? 'selected' : '' }}>Asistencia</option>
                                    </select>

                                </td> 
                            </tr>

                            <input type="hidden" name="idAsistencia[]" value="{{$asistencia->id}}">
            
                        @endforeach            
                    </tbody>
            </table>
            <br>

            <div class="center">
                <button  style="background:#B8860B" class="waves-effect waves-light btn-small">Guardar cambios<i class="material-icons right">save</i></button>
            </div>
            <br>

        </form>

    @endif

@endsection


@section('modal')


    <!-- mensaje de actualizar asistencia -->
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