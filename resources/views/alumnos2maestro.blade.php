@extends('layouts.materialize3')

@section('head')
    Alumnos
@endsection

@section('titulo')
    Alumnos en {{Str::lower($tallers->taller)}} {{$tallers->periodo->periodo}}
@endsection

@section('contenido')

    @if ($alumnos->count() == 0)

        <div class="center">
            <p class="white-text">Aún no se han inscrito tus alumnos en el taller</p>
            <img class="circle" width="250px" height="250px" src="https://i0.wp.com/gatolia.com/wp-content/uploads/2021/04/dibujos-animados-lindo-regreso-escuela-gatos-leyendo-libro_39961-1362.jpg?resize=626%2C450&ssl=1">
        </div>
        
    @else

        @livewire('alumnos-maestro', ['idtaller' => $tallers->id])

    @endif
        

@endsection