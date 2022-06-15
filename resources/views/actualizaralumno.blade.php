@extends('layouts.materialize2')

@section('head')
    Actualiza tu perfil
@endsection

@section('titulo')
    Actualiza tu perfil
@endsection

@section('contenido')
    <div class="row">
  
        <div class="col s8 offset-s2 black">

            <div class="center">
                <br>
                <img class="circle" src="https://brandem.mx/wp-content/uploads/2018/12/FELINOS_mascota.jpg" width="150px" height="150px">
            </div>

            
            <form method="POST" action="{{ route('alumno.update',$Alumno->id)}}">
                @csrf
                @method('put')

                <div class="container cuerpo">


                    @if (empty($Alumno->taller->taller))
                        <p class="white-text">Taller: Sin taller</p>
                    @else
                        <p class="white-text">Taller: {{$Alumno->taller->taller}}</p>
                    @endif
                   
                    
                    <div class="input-field">
                        <span class="white-text"> Nombre(s): </span> 
                        <input id="nombre" name="nombre" type="text" class="@error('nombre') is-invalid @enderror grey lighten-2"  value="{{old('nombre',$Alumno->user->name)}}" autofocus>
                        @error('nombre')
                            <span class="alert alert-danger red-text">{{$message}}</span>
                        @enderror()
                    </div>

                    <div class="input-field">
                        <span class="white-text"> Apellido(s): </span> 
                        <input id="apellido" name="apellido" type="text" class="@error('apellido') is-invalid @enderror grey lighten-2"  value="{{old('apellido',$Alumno->user->last_name)}}">
                        @error('apellido')
                            <span class="alert alert-danger red-text">{{$message}}</span>
                        @enderror()
                    </div>

                    <div class="input-field">
                        <span class="white-text"> Correo institucional: </span> 
                        <input disabled  type="text" class="grey lighten-2"  value="{{$Alumno->user->email}}">
                    </div>

                    <div class="input-field">
                        <span class="white-text"> Matrícula: </span> 
                        <input disabled  type="text" class="grey lighten-2"  value="{{$Alumno->matricula}}">
                    </div>


                
                    <div class="input-field">
                        <span class="white-text"> Edad: </span> 
                        <input id="edad" name="edad" type="number" class="@error('edad') is-invalid @enderror grey lighten-2"  value="{{old('edad',$Alumno->edad)}}">

                        @error('edad')
                            <span class="alert alert-danger red-text">{{$message}}</span>
                        @enderror()
                        
                    </div>


                    <div>
                        <span class="white-text">Sexo:</span>
                        
                        <label>
                            <input class="@error('sexo') is-invalid @enderror with-gap" value="1" @if($Alumno->sexo == 'Masculino') checked  @endif  {{(old('sexo') == 1) ? 'checked' : ''}} name="sexo" type="radio" />
                            <span>Masculino</span>
                        </label>
                        
                        <label>
                            <input class="@error('sexo') is-invalid @enderror with-gap" value="2" @if($Alumno->sexo == 'Femenino') checked  @endif  {{(old('sexo') == 2) ? 'checked' : ''}} name="sexo" type="radio" />
                            <span>Femenino</span>
                        </label> 

                        <div>
                            @error('sexo')
                                <span class="alert alert-danger red-text">{{$message}}</span>
                            @enderror
                        </div>
                
                    </div>

       

                    <div class="input-field">
                        <span class="white-text"> Teléfono: </span> 
                        <input id="telefono"  name="telefono" type="text" class="@error('telefono') is-invalid @enderror grey lighten-2" value="{{old('telefono', $Alumno->telefono)}}" >

                        @error('telefono')
                            <span class="alert alert-danger red-text">{{$message}}</span>
                        @enderror()
                        
                    </div>

                    <div>
                        <span class="white-text">Carrera</span>
                        <select name="carrera" class="@error('carrera') is-invalid @enderror browser-default grey lighten-2">
                            <option value="1" @if($Alumno->carrera == 'Ingeniería en Sistemas Computacionales') selected  @endif   {{ old('carrera') == 1 ? 'selected' : '' }}>Ingeniería en Sistemas Computacionales</option>
                            <option value="2" @if($Alumno->carrera == 'Ingeniería Industrial') selected  @endif   {{ old('carrera') == 2 ? 'selected' : '' }}>Ingeniería Industrial</option>
                            <option value="3" @if($Alumno->carrera == 'Ingeniería Electrónica') selected  @endif   {{ old('carrera') == 3 ? 'selected' : '' }}>Ingeniería Electrónica</option>
                            <option value="4" @if($Alumno->carrera == 'Ingeniería en Energías Renovables') selected  @endif  {{ old('carrera') == 4 ? 'selected' : '' }}>Ingeniería en Energías Renovables</option>
                            <option value="5" @if($Alumno->carrera == 'Ingeniería Electromécanica') selected  @endif  {{ old('carrera') == 5 ? 'selected' : '' }}>Ingeniería Electromécanica</option>
                        </select>

                        @error('carrera')
                            <span class="alert alert-danger red-text">{{$message}}</span>
                        @enderror
                    </div>
                    <br>
  
                    <div>
                        <span class="white-text">Cultura etnia:</span>
                        
                        <label>
                            <input class="@error('culturaetnia') is-invalid @enderror with-gap" value="1" @if($Alumno->culturaetnia== 'Si') checked  @endif  {{(old('culturaetnia') == 1) ? 'checked' : ''}} name="culturaetnia" type="radio" />
                            <span>Si</span>
                        </label>
                        
                        <label>
                            <input class="@error('culturaetnia') is-invalid @enderror with-gap" value="2" @if($Alumno->culturaetnia == 'No') checked  @endif  {{(old('culturaetnia') == 2) ? 'checked' : ''}} name="culturaetnia" type="radio" />
                            <span>No</span>
                        </label> 

                        <div>
                            @error('culturaetnia')
                                <span class="alert alert-danger red-text">{{$message}}</span>
                            @enderror
                        </div>
                
                    </div>
                    <br>

                    <div>
                        <span class="white-text">Municipio:</span>
                        <select name="municipio" class="@error('municipio') is-invalid @enderror browser-default grey lighten-2" >
    
                            <option hidden value="{{$Alumno->municipio->id}}">{{$Alumno->municipio->municipio}}</option>
                            
                            @foreach($municipio as $municipios)
                                <option value="{{$municipios->id}}" {{ old('municipio') == $municipios->id ? "selected" :""}}>{{$municipios->municipio}}</option>
                            @endforeach
                        </select>
                        
                        @error('municipio')
                            <span class="alert alert-danger red-text">{{$message}}</span>
                        @enderror

                    </div>
                    <br>

                    <div>
                        <span class="white-text">Discapacidad:</span>
                        
                        <label>
                            <input class="@error('discapacidad') is-invalid @enderror with-gap" value="1" @if($Alumno->discapacidad == 'Si') checked  @endif  {{(old('discapacidad') == 1) ? 'checked' : ''}} name="discapacidad" type="radio" />
                            <span>Si</span>
                        </label>
                        
                        <label>
                            <input class="@error('discapacidad') is-invalid @enderror with-gap" value="2" @if($Alumno->discapacidad == 'No') checked  @endif  {{(old('discapacidad') == 2) ? 'checked' : ''}} name="discapacidad" type="radio" />
                            <span>No</span>
                        </label> 

                        <div>
                            @error('discapacidad')
                                <span class="alert alert-danger red-text">{{$message}}</span>
                            @enderror
                        </div>

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