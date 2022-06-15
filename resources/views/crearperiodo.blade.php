@extends('layouts.materialize4')

@section('head')
    Crear periodo
@endsection

@section('titulo')
    Crear periodo
@endsection

@section('contenido')

<div class="row">
  
  <div class="col s8 offset-s2 black">
       
        <form method="POST" action="/periodo/store">
            @csrf

            <div class="container">

                <div class="input-field">
                    <span class="white-text"> Periodo: </span> 
                    <input id="periodo" name="periodo" type="text" class="@error('periodo') is-invalid @enderror grey lighten-2"  value="{{old('periodo')}}" autofocus>

                    @error('periodo')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror()
                    
                </div>

                <div>
                    <span class="white-text"> Fecha de emisión: </span> 
                    <input name="fechaemision" id="fechaemision" type="date" class="@error('fechaemision') is-invalid @enderror grey lighten-2" value="{{old('fechaemision')}}">

                    @error('fechaemision')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror()
                </div>
                <br>

                <div>
                    <span class="white-text"> Fecha de expiración: </span> 
                    <input name="fechaexpiracion" id="fechaexpiracion" type="date" class="@error('fechaexpiracion') is-invalid @enderror grey lighten-2" value="{{old('fechaexpiracion')}}">

                    @error('fechaexpiracion')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror()
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