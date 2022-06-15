@extends('layouts.materialize')

@section('head')
    Datos personales del alumno
@endsection

@section('titulo')
    Datos personales del alumno
@endsection

@section('contenido')

<div class="row cuerpo">

    <div class="container">
        <div class="card white">
            <b><p style="color:#1B396A;font-size:larger" class="center">¡Ya casi acabas tu registro! Solo necesitamos que nos proporciones algo más de información sobre ti.</p></b>
        </div>
    </div>

  <div class="col s8 offset-s2 white">
        <div class="center">
            <br>

            <img class="circle" src="https://brandem.mx/wp-content/uploads/2018/12/FELINOS_mascota.jpg" width="150px" height="150px">
        </div>

        

        <form method="POST" action="/alumno/store">
            @csrf

            <div class="container">

                
                <div class="input-field">
                    <span> Edad: </span> 
                    <input id="edad" name="edad" type="number" class="@error('edad') is-invalid @enderror grey lighten-2"  value="{{old('edad')}}" autofocus>

                    @error('edad')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror()
                    
                </div>


                <div>
                    <span>Sexo:</span>
                    
                    <label>
                        <input class="@error('sexo') is-invalid @enderror with-gap" value="1" {{(old('sexo') == 1) ? 'checked' : ''}} name="sexo" type="radio" />
                        <span>Masculino</span>
                    </label>
                    
                    <label>
                        <input class="@error('sexo') is-invalid @enderror with-gap" value="2" {{(old('sexo') == 2) ? 'checked' : ''}} name="sexo" type="radio" />
                        <span>Femenino</span>
                    </label> 

                    <div>
                        @error('sexo')
                            <span class="alert alert-danger red-text">{{$message}}</span>
                        @enderror
                    </div>
            
                </div>

       

                <div class="input-field">
                    <span> Teléfono: </span> 
                    <input id="telefono"  name="telefono" type="text" class="@error('telefono') is-invalid @enderror grey lighten-2" value="{{old('telefono')}}" >

                    @error('telefono')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror()
                    
                </div>

                <div>
                    <span>Carrera</span>
                    <select name="carrera" class="@error('carrera') is-invalid @enderror browser-default grey lighten-2">
                        <option value="" disabled selected></option>
                        <option value="1" {{ old('carrera') == 1 ? 'selected' : '' }}>Ingeniería en Sistemas Computacionales</option>
                        <option value="2" {{ old('carrera') == 2 ? 'selected' : '' }}>Ingeniería Industrial</option>
                        <option value="3" {{ old('carrera') == 3 ? 'selected' : '' }}>Ingeniería Electrónica</option>
                        <option value="4" {{ old('carrera') == 4 ? 'selected' : '' }}>Ingeniería en Energías Renovables</option>
                        <option value="5" {{ old('carrera') == 5 ? 'selected' : '' }}>Ingeniería Electromécanica</option>
                    </select>

                    @error('carrera')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror
                </div>
                <br>
  
                <div>
                    <span>Cultura etnia:</span>
                    
                    <label>
                        <input class="@error('culturaetnia') is-invalid @enderror with-gap" value="1" {{(old('culturaetnia') == 1) ? 'checked' : ''}} name="culturaetnia" type="radio" />
                        <span>Si</span>
                    </label>
                    
                    <label>
                        <input class="@error('culturaetnia') is-invalid @enderror with-gap" value="2" {{(old('culturaetnia') == 2) ? 'checked' : ''}} name="culturaetnia" type="radio" />
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
                    <span>Municipio:</span>
                    <select name="municipio" class="@error('municipio') is-invalid @enderror browser-default grey lighten-2" >
                        <option value="" disabled selected></option>
                        
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
                    <span>Discapacidad:</span>
                    
                    <label>
                        <input class="@error('discapacidad') is-invalid @enderror with-gap" value="1" {{(old('discapacidad') == 1) ? 'checked' : ''}} name="discapacidad" type="radio" />
                        <span>Si</span>
                    </label>
                    
                    <label>
                        <input class="@error('discapacidad') is-invalid @enderror with-gap" value="2" {{(old('discapacidad') == 2) ? 'checked' : ''}} name="discapacidad" type="radio" />
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
                    <button class="waves-effect waves-light btn-small">Enviar datos<i class="fa-solid fa-paper-plane right" ></i></button>
                </div>

            </div>
            
        </form>
        
        <br>
    </div>

</div>

@endsection

@section('modal')
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                confirmButtonText: 'Aceptar!',
                title: "{{session('error')}}",
            })
        </script>
    @endif
@endsection