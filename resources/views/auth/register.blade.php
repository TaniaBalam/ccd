@extends('layouts.materialize')

@section('head')
    Registro
@endsection

@section('titulo')
    Registro
@endsection

@section('contenido')
<div class="row">
  
  <div class="col s12 m8 offset-m2 white cuerpo">

    <div class="center">
      <br>

      <img class="circle" src="https://brandem.mx/wp-content/uploads/2018/12/FELINOS_mascota.jpg" width="150px" height="150px">
    </div>

      

    <form method="POST" action="{{ route('register') }}">
    @csrf

      <div class="container">

        <div class="input-field">
            <span>Nombre(s):</span> 
            <input id="name" name="name" type="text"  class="@error('nombre') is-invalid @enderror grey lighten-2" value="{{old('name')}}"  autofocus>
            
            @error('name')
              <span class="alert alert-danger red-text">{{$message}}</span>
            @enderror
        </div>
  
        <div class="input-field">
            <span>Apellido(s):</span> 
            <input id="last_name" name="last_name" type="text" class="@error('last_name') is-invalid @enderror grey lighten-2"  value="{{old('last_name')}}" >

            @error('last_name')
              <span class="alert alert-danger red-text">{{$message}}</span>
            @enderror
        </div>
        

        <div class="input-field">
          <span> Correo institucional: </span> 
          <input id="email" name="email" type="email"  class="@error('email') is-invalid @enderror grey lighten-2" value="{{old('email')}}" >

          @error('email')
              <span class="alert alert-danger red-text">{{$message}}</span>
            @enderror
        </div>
        

        <div class="input-field">
            <span> Contraseña: </span> 
            <input id="password"  name="password" type="password"  class="@error('password') is-invalid @enderror grey lighten-2" autocomplete="new-password">

            @error('password')
              <span class="alert alert-danger red-text">{{$message}}</span>
            @enderror
        </div>
      


        <div class="input-field">
          <span> Verificar contraseña: </span>
          <input id="password_confirmation" name="password_confirmation" type="password"  class="grey lighten-2" required>
        </div>
        <br>
      

        <div class="center">
          <button style="background:#1B396A" class="waves-effect waves-light btn-small">Registrarse<i class="fa-solid fa-pen-to-square right" ></i></button>
        </div>

      </div>

  
    </form>

    <div class="center">
      <br>
      <a style="color:#1B396A" href="{{ route('login') }}"><span >¿Ya te has registrado?</span></a>
    </div>
    
    <br>
  </div>
</div>
@endsection
