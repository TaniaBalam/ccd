@extends('layouts.materialize4')

@section('head')
    Crear maestro
@endsection

@section('titulo')
    Crear maestro
@endsection

@section('contenido')

<div class="row">
  
  <div class="col s8 offset-s2 black">
        <div class="center">
            <br>

            <img class="circle" src="https://brandem.mx/wp-content/uploads/2018/12/FELINOS_mascota.jpg" width="150px" height="150px">
        </div>

        
        <form method="POST" action="/maestroadmin/store">
            @csrf

            <div class="container">

                <div class="input-field">
                    <span class="white-text">Nombre(s):</span> 
                    <input id="nombre" name="nombre" type="text"  class="@error('nombre') is-invalid @enderror grey lighten-2" value="{{old('nombre')}}"  autofocus>
                    
                    @error('nombre')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror
                </div>
        
                <div class="input-field">
                    <span class="white-text">Apellido(s):</span> 
                    <input id="apellido" name="apellido" type="text" class="@error('apellido') is-invalid @enderror grey lighten-2"  value="{{old('apellido')}}" >

                    @error('apellido')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror
                </div>
            

                <div class="input-field">
                    <span class="white-text"> Correo institucional: </span> 
                    <input id="email" name="email" type="email"  class="@error('email') is-invalid @enderror grey lighten-2" value="{{old('email')}}" >

                    @error('email')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror
                </div>
            

                <div class="input-field">
                    <span class="white-text"> Contraseña: </span> 
                    <input id="password"  name="password" type="password"  class="@error('password') is-invalid @enderror grey lighten-2" autocomplete="new-password">

                    @error('password')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror
                </div>
            

                <div class="input-field">
                    <span class="white-text"> Verificar contraseña: </span>
                    <input id="password_confirmation" name="password_confirmation" type="password"  class="grey lighten-2" required>
                </div>
               
                <div class="input-field">
                    <span class="white-text"> Número de maestro: </span> 
                    <input id="numero" name="numero" type="text" class="@error('numero') is-invalid @enderror grey lighten-2"  value="{{old('numero')}}">

                    @error('numero')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror
                    
                </div>
                <br>

                <div class="center">
                    <button style="background:#1B396A" class="waves-effect waves-light btn-small">Enviar datos<i class="fa-solid fa-paper-plane right" ></i></button>
                </div>

            </div>
            
        </form>
        
        <br>
    </div>

</div>

@endsection