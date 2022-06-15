@extends('layouts.materialize4')

@section('head')
    Crear taller
@endsection

@section('titulo')
    Crear taller
@endsection

@section('contenido')

<div class="row">
  
  <div class="col s8 offset-s2 black">
       
        <form method="POST" action="/taller/store">
            @csrf

            <div class="container">

                <div class="input-field">
                    <span class="white-text"> Nombre del taller: </span> 
                    <input id="taller" name="taller" type="text" class="@error('taller') is-invalid @enderror grey lighten-2"  value="{{old('taller')}}" autofocus>

                    @error('taller')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror()
                    
                </div>

                <div>
                    <span class="white-text"> Descripción: </span> 
                    <textarea id="descripcion" name="descripcion" cols="30" rows="10" placeholder="En este taller aprenderas..." class="@error('descripcion') is-invalid @enderror grey lighten-2"></textarea>

                    @error('descripcion')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror()
                </div>

               
                <div>
                    <span class="white-text">Maestro:</span>
                    <select name="maestro" class="@error('maestro') is-invalid @enderror browser-default grey lighten-2" >
                        <option value="" disabled selected></option>
                        
                        @foreach($usuarios as $usuario)
                            @if ($usuario->hasRole('maestro'))
                                <option value="{{$usuario->maestro->id}}" {{ old('maestro') == $usuario->maestro->id ? "selected" :""}}>{{$usuario->name . ' ' . $usuario->last_name}}</option>
                            @endif
                        @endforeach
                    </select>
                    
                    @error('maestro')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror

                </div>
              
                <div class="input-field">
                    <span class="white-text"> Horario: </span> 
                    <input id="horario" name="horario" type="text" class="@error('horario') is-invalid @enderror grey lighten-2"  value="{{old('horario')}}">

                    @error('horario')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror()    
                </div>


                <div>
                    <span class="white-text">Periodo:</span>
                    <select name="periodo" class="@error('periodo') is-invalid @enderror browser-default grey lighten-2" >
                        <option value="" disabled selected></option>
                        
                        @foreach($periodos as $periodo)
                            <option value="{{$periodo->id}}" {{ old('periodo') == $periodo->id ? "selected" :""}}>{{$periodo->periodo}}</option>
                        @endforeach
                    </select>
                    
                    @error('periodo')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror

                </div>


                <div class="input-field">
                    <span class="white-text"> URL de la imagen: </span> 
                    <input id="imagen" name="imagen" type="text" class="@error('imagen') is-invalid @enderror grey lighten-2"  value="{{old('imagen')}}">

                    @error('imagen')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror()    
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