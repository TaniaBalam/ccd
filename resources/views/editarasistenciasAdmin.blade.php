@extends('layouts.materialize4')

@section('head')
    Asistencias
@endsection

@section('titulo')
    Asistencias
@endsection

@section('contenido')


    @if ($asistencias->count()==0)
        
        <div class="center">
            <p class="white-text">Este taller no tiene asistencias aplicadas</p>
            <img class="circle" width="250px" height="250px" src="https://media.istockphoto.com/vectors/cartoon-cute-back-to-school-teacher-cat-writing-paper-vector-vector-id1165676177">
        </div>
    @else

        <form method="POST" action="{{route('asisAdmin.update')}}">
            @csrf
            @method('put')

            <table class="highlight responsive-table">
                    
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
                <button style="background:#1B396A" class="waves-effect waves-light btn-small">Guardar cambios<i class="fa-solid fa-paper-plane right" ></i></button>
            </div>
            <br>

        </form>

    @endif

@endsection