@extends('layouts.materialize4')

@section('head')
    Alumnos / asistencias
@endsection

@section('titulo')
    Alumnos / asistencias
@endsection

@section('contenido')

    @can('editar alumno')
        <a style="background:#B8860B" class="btn col s12" href="{{route('crearalumnoadmin')}}"><i class="material-icons left">person_add</i>Crear alumno</a>
    @endcan

    <div class="row">
        
        @foreach($tallers as $taller)
            <div class="col s12 l6">
                <ul class="collection">
                    <li class="collection-item avatar">
                        <b><span class="title">{{$taller->taller}} {{$taller->periodo->periodo}}</span></b>
                        <img src="{{$taller->imagen}}" alt="" class="circle">
                        <p>Número de alumnos: {{$taller->alumnos->count()}}</p>
                        <br>
                        <p><a style="color:#B8860B" href="{{route('vistaveralumnosadmin', $taller->id)}}"><i class="material-icons">group</i>Alumnos</a></p>
                        @can('editar alumno') 
                            <p><a style="color:#B8860B" href="{{route('vistaverasis', $taller->id)}}"><i class="material-icons">assignment_turned_in</i>Asistencias</a></p>
                        @endcan

                        <p><a style="color:#B8860B" href="{{route('reporteasistenciaAdmin', $taller->id)}}"><i class="material-icons">event_note</i>Reporte de asistencias</a></p>
                    </li>
                </ul>
            </div>
        @endforeach
        
    </div>

    {{$tallers->links('vendor.pagination.materializecss')}}


@endsection