@extends('layouts.materialize3')

@section('head')
    Actualizar perfil
@endsection

@section('titulo')
    Actualizar perfil
@endsection

@section('contenido')
    <div class="row">
  
        <div class="col s8 offset-s2 black">

            <div class="center">
                <br>
                <img class="circle" src="https://brandem.mx/wp-content/uploads/2018/12/FELINOS_mascota.jpg" width="150px" height="150px">
            </div>

            <form method="POST" action="{{ route('maestro.update',$maestros->id)}}">
                @csrf
                @method('put')

                <div class="container">

                    <div class="input-field">
                        <span class="white-text"> Nombre(s): </span> 
                        <input id="nombre" name="nombre" type="text" class="@error('nombre') is-invalid @enderror grey lighten-2"  value="{{old('nombre',$maestros->user->name)}}">
                        @error('nombre')
                            <span class="alert alert-danger red-text">{{$message}}</span>
                        @enderror()
                    </div>

                    <div class="input-field">
                        <span class="white-text"> Apellido(s): </span> 
                        <input id="apellido" name="apellido" type="text" class="@error('apellido') is-invalid @enderror grey lighten-2"  value="{{old('apellido',$maestros->user->last_name)}}">
                        @error('apellido')
                            <span class="alert alert-danger red-text">{{$message}}</span>
                        @enderror()
                    </div>

                    <div class="input-field">
                        <span class="white-text"> Correo institucional: </span> 
                        <input disabled  type="text" class="grey lighten-2"  value="{{$maestros->user->email}}">
                    </div>

                    <div class="input-field">
                        <span class="white-text"> Número de maestro: </span> 
                        <input disabled type="text" class="grey lighten-2"  value="{{$maestros->numero}}">
                    </div>

                    <div class="center">
                        <button style="background:#1B396A" class="waves-effect waves-light btn-small">Enviar datos<i class="fa-solid fa-paper-plane right" ></i></button>
                    </div>
                </div>
            </form>
            <br>
        </div>
    </div>

@endsection