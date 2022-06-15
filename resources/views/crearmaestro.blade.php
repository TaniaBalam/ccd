@extends('layouts.materialize')

@section('head')
    Datos del maestro
@endsection

@section('titulo')
    Datos del maestro
@endsection

@section('contenido')

<div class="row cuerpo">

    <p>¡Ya casi acabas tu registro! Solo necesitamos que nos proporciones algo más de información sobre ti.</p>
  
  <div class="col s8 offset-s2 white">
        <div class="center">
            <br>

            <img class="circle" src="https://brandem.mx/wp-content/uploads/2018/12/FELINOS_mascota.jpg" width="150px" height="150px">
        </div>

        

        <form method="POST" action="/maestro/store">
            @csrf

            <div class="container">


                <div class="input-field">
                    <span> Número de maestro: </span> 
                    <input id="numero" name="numero" type="text" class="@error('numero') is-invalid @enderror grey lighten-2"  value="{{old('numero')}}" autofocus>

                    @error('numero')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror
                    
                </div>

 
           <!-- <div>
                    <span>Taller:</span>
                    <select name="taller" class="@error('taller') is-invalid @enderror browser-default grey lighten-2" >
                        <option value="" disabled selected></option>
                        
                        @foreach($taller as $tallers)
                            <option value="{{$tallers->id}}" {{ old('taller') == $tallers->id ? "selected" :""}}>{{$tallers->taller}}</option>
                        @endforeach
                    </select>
                    
                    @error('taller')
                        <span class="alert alert-danger red-text">{{$message}}</span>
                    @enderror

                </div> -->
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