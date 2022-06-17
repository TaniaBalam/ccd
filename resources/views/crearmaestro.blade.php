@extends('layouts.materialize')

@section('head')
    Datos del maestro
@endsection

@section('titulo')
    Datos del maestro
@endsection

@section('contenido')

<div class="row cuerpo">

    <div class="container">
        <div class="card white">
            <b><p style="color:#1B396A;font-size:larger" class="center">¡Ya casi acabas tu registro! Solo necesitamos que nos proporciones algo más de información sobre ti.</p></b>
        </div>
    </div>
  
  <div class="col s12 m8 offset-m2 white">
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