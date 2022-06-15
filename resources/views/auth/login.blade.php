@extends('layouts.materialize')

@section('head')
    Iniciar sesión
@endsection

@section('titulo')
    Iniciar sesión
@endsection

@section('contenido')
<div class="row">
  
  <div class="col s8 offset-s2 white cuerpo">
        <div class="center">
            <br>

            <img class="circle" src="https://brandem.mx/wp-content/uploads/2018/12/FELINOS_mascota.jpg" width="150px" height="150px">
        </div>

       
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="container">

              
                <div class="input-field">
                    <span> Correo institucional:  @itsmotul.edu.mx</span> 
                    <input id="email" name="email" type="email" class="@error('email') is-invalid @enderror grey lighten-2"  value="{{old('email')}}" autofocus>

                    @error('email')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror
                  
                </div>
                    

                   
                <div class="input-field">
                    <span> Contraseña: </span> 
                    <input id="password"  name="password" type="password" class="@error('password') is-invalid @enderror grey lighten-2"  autocomplete="new-password">

                    @error('password')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror
                </div>


                <div class="center">
                    <button class="waves-effect waves-light btn-small">Iniciar sesión<i class="fa-solid fa-paper-plane right" ></i></button>
                </div>
            </div>
            
        </form>
        <div class="center">
            <br>
            <a href="{{ route('register') }}"><span >¿No te has registrado?</span></a>
            
        </div>
        <br>
    </div>

</div>
@endsection
