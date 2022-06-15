<div>

    <div class="row">
    
        <div class="col s12 m8 offset-m2 black">

            <div class="center">
                <br>
                <img class="circle" src="https://brandem.mx/wp-content/uploads/2018/12/FELINOS_mascota.jpg" width="150px" height="150px">
            </div>

            <form wire:submit.prevent="update">

                <div class="container cuerpo">
                    <input wire:model="idalumno" id="id" name="id" type="hidden" class="grey lighten-2">

                    @if (empty($Alumno->taller->taller))
                        <p class="white-text">Taller: Sin taller</p>
                    @else
                        <p class="white-text">Taller: {{$Alumno->taller->taller}}</p>
                    @endif
                    
                    <div class="input-field">
                        <span class="white-text"> Nombre(s): </span> 
                        @error('name') <span class="red-text"> {{$message}}</span> @enderror
                        <input wire:model="name" id="nombre" name="nombre" type="text" class="grey lighten-2"  value="{{old('nombre',$Alumno->user->name)}}" autofocus>
                    </div>

                    <div class="input-field">
                        <span class="white-text"> Apellido(s): </span> 
                        @error('last_name') <span class="red-text"> {{$message}}</span> @enderror
                        <input wire:model="last_name" id="apellido" name="apellido" type="text" class="@error('apellido') is-invalid @enderror grey lighten-2"  value="{{old('apellido',$Alumno->user->last_name)}}">
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
                        @error('edad') <span class="red-text"> {{$message}}</span> @enderror
                        <input  wire:model="edad" id="edad" name="edad" type="number" class="grey lighten-2"  value="{{old('edad',$Alumno->edad)}}">
                    </div>

                    <div>
                        <span class="white-text">Sexo:</span>
                        <label>
                            <input wire:click="opcion(1,'sexo')" class="with-gap" value="1" @if($sexo == 'Masculino' or $sexo == 1) checked  @endif  {{(old('sexo') == 1) ? 'checked' : ''}} name="sexo" type="radio" />
                            <span>Masculino</span>
                        </label>
                        
                        <label>
                            <input wire:click="opcion(2,'sexo')" class="with-gap" value="2" @if($sexo == 'Femenino' or $sexo == 2) checked  @endif  {{(old('sexo') == 2) ? 'checked' : ''}} name="sexo" type="radio" />
                            <span>Femenino</span>
                        </label>  
                                       
                    </div>

                    <div class="input-field">
                        <span class="white-text"> Teléfono: </span> 
                        @error('telefono') <span class="red-text"> {{$message}}</span> @enderror
                        <input wire:model="telefono" id="telefono"  name="telefono" type="text" class="grey lighten-2" value="{{old('telefono', $Alumno->telefono)}}" >
                    </div>

                    <div>
                        <span class="white-text">Carrera</span>
                        @error('car') <span class="red-text"> {{$message}}</span> @enderror
                        <select wire:model="car" name="carrera" class="browser-default grey lighten-2">
                            @if($Alumno->carrera == 'Ingeniería en Sistemas Computacionales')
                                <option hidden value="1" selected >Ingeniería en Sistemas Computacionales</option>
                            @endif
                            @if($Alumno->carrera == 'Ingeniería Industrial')
                                <option hidden value="2" selected>Ingeniería Industrial</option>
                            @endif
                            @if($Alumno->carrera == 'Ingeniería Electrónica') 
                                <option hidden value="3" selected>Ingeniería Electrónica</option>
                            @endif

                            @if($Alumno->carrera == 'Ingeniería en Energías Renovables') 
                                <option hidden value="4" selected>Ingeniería en Energías Renovables</option>
                            @endif  

                            @if($Alumno->carrera == 'Ingeniería Electromécanica') 
                                <option hidden value="5" selected>Ingeniería Electromécanica</option>
                            @endif

                            <option value="1" >Ingeniería en Sistemas Computacionales</option>
                            <option value="2" >Ingeniería Industrial</option>
                            <option value="3" >Ingeniería Electrónica</option>
                            <option value="4" >Ingeniería en Energías Renovables</option>
                            <option value="5" >Ingeniería Electromécanica</option>
                        </select>
                    </div>
                    <br>

                    <div>
                        <span class="white-text">Cultura etnia:</span>
                        
                        <label>
                            <input wire:click="opcion(1,'cultura')" name="culturaetnia" class="with-gap" value="1" @if($cultura == 'Si' or $cultura == 1) checked  @endif  {{(old('culturaetnia') == 1) ? 'checked' : ''}} name="culturaetnia" type="radio" />
                            <span>Si</span>
                        </label>
                        
                        <label>
                            <input wire:click="opcion(2,'cultura')" name="culturaetnia" class=" with-gap" value="2" @if($cultura == 'No' or $cultura == 2) checked  @endif  {{(old('culturaetnia') == 2) ? 'checked' : ''}} name="culturaetnia" type="radio" />
                            <span>No</span>
                        </label> 
                    </div>
                    <br>

                    <input wire:model="muniid" type="hidden">
                    <div>
                        <span class="white-text">Municipio:</span>
                        <select wire:model="muni" name="municipio" class="@error('municipio') is-invalid @enderror browser-default grey lighten-2" >

                            @if($Alumno->municipio->municipio == $muni)
                                <option hidden value="64">{{$Alumno->municipio->municipio}}</option>
                            @endif
                            
                            @foreach($municipio as $municipios)
                                <option value="{{$municipios->id}}" {{ old('municipio') == $municipios->id ? "selected" :""}}>{{$municipios->municipio}}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>

                    <div>
                        <span class="white-text">Discapacidad:</span>
                        <label>
                            <input wire:click="opcion(1,'discapacidad')" class="with-gap" value="1" @if($discapacidad == 'Si' or $discapacidad == 1) checked  @endif  {{(old('discapacidad') == 1) ? 'checked' : ''}} name="discapacidad" type="radio" />
                            <span>Si</span>
                        </label>
                        <label>
                            <input wire:click="opcion(2,'discapacidad')" class="with-gap" value="2" @if($discapacidad == 'No' or $discapacidad == 2) checked  @endif  {{(old('discapacidad') == 2) ? 'checked' : ''}} name="discapacidad" type="radio" />
                            <span>No</span>
                        </label> 
                    </div>
                    <br>

                    <div class="center">
                        <button style="background:#1B396A" class="waves-effect waves-light btn-small">Guardar cambios<i class="material-icons right">save</i></button>
                    </div>

                </div>

            </form>

        <br>
        </div>
    </div>

</div>
