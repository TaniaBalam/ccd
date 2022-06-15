
<!-- Modal Trigger -->
@can('editar alumno')
    <a style="background:#B8860B" class="btn col s12 modal-trigger" href="#modal1"><i class="material-icons left">person_add</i>Crear alumno</a>
    <br><br>
@endcan

<!-- Modal Structure -->
<div wire:ignore.self id="modal1" class="modal black cuerpo">

    <div class="center">
        <br>
        <img class="circle" src="https://brandem.mx/wp-content/uploads/2018/12/FELINOS_mascota.jpg" width="100px" height="100px">
    </div>

    <div class="modal-content">
        <form wire:submit.prevent="submit">



        <span class="white-text">Nombre(s):</span> 
        @error('name') <span class="red-text"> {{$message}}</span> @enderror
        <input type="text"  class="grey lighten-2" wire:model="name" >

        <span class="white-text">Apellido(s):</span> 
        @error('last_name') <span class="red-text">{{$message}}</span> @enderror
        <input type="text"  class="grey lighten-2" wire:model="last_name" >

        <span class="white-text">Correo institucional:</span> 
        @error('email')<span class="red-text">{{$message}}</span> @enderror
        <input type="email"  class="grey lighten-2" wire:model="email" >  

        <span class="white-text"> Contraseña: </span> 
        @error('password')<span class="red-text">{{$message}}</span> @enderror
        <input wire:model="password" type="password"  class="grey lighten-2" autocomplete="new-password">

        <div>
            <span class="white-text">Edad:</span> 
            @error('edad')<span class="red-text">{{$message}}</span> @enderror
            <input type="number"  class="grey lighten-2" wire:model="edad" >
        </div>
        <br>

        <div>
            <span class="white-text">Sexo:</span> 
            <label >
                <input wire:model="sexo" class="with-gap" value="1" {{(old('sexo') == 1) ? 'checked' : ''}} name="sexo" type="radio" />
                <span>Masculino</span>
            </label>


            <label> 
                <input wire:model="sexo" class="with-gap" value="2" {{(old('sexo') == 2) ? 'checked' : ''}} name="sexo" type="radio" />
                <span>Femenino</span>
            </label> 
            @error('sexo')<span class="red-text">{{$message}}</span> @enderror 
        </div>
        <br>

        <span class="white-text">Teléfono:</span>
        @error('telefono')<span class="red-text">{{$message}}</span> @enderror 
        <input type="number"  class="grey lighten-2" wire:model="telefono" > 

        <span class="white-text">Carrera</span>
        @error('carrera')<span class="red-text">{{$message}}</span> @enderror 
        <select wire:model="carrera" name="carrera" class="browser-default grey lighten-2">
            <option value="" selected> </option>
            <option value="1" {{ old('carrera') == 1 ? 'selected' : '' }}>Ingeniería en Sistemas Computacionales</option>
            <option value="2" {{ old('carrera') == 2 ? 'selected' : '' }}>Ingeniería Industrial</option>
            <option value="3" {{ old('carrera') == 3 ? 'selected' : '' }}>Ingeniería Electrónica</option>
            <option value="4" {{ old('carrera') == 4 ? 'selected' : '' }}>Ingeniería en Energías Renovables</option>
            <option value="5" {{ old('carrera') == 5 ? 'selected' : '' }}>Ingeniería Electromécanica</option>
        </select>
        <br>

        <div>
        <span class="white-text">Cultura etnia:</span>            
        <label>
            <input wire:model="cult" class="with-gap" value="1" {{(old('culturaetnia') == 1) ? 'checked' : ''}} name="culturaetnia" type="radio" />
            <span>Si</span>
        </label>

        <label>
            <input wire:model="cult" class=" with-gap" value="2" {{(old('culturaetnia') == 2) ? 'checked' : ''}} name="culturaetnia" type="radio" />
            <span>No</span>
        </label> 
        @error('cult') <span class="red-text"> {{$message}}</span> @enderror
        </div>
        <br>

        <span class="white-text">Municipio:</span>
        @error('muni') <span class="red-text"> {{$message}}</span> @enderror
        <select wire:model="muni" name="municipio" class="browser-default grey lighten-2" >
       
        <option hidden value=""></option>
            @foreach($municipio as $municipios)
                <option value="{{$municipios->id}}" {{ old('municipio') == $municipios->id ? "selected" :""}}>{{$municipios->municipio}}</option>
            @endforeach
        </select>
        <br>

        <div>
            <span class="white-text">Discapacidad:</span>                
            <label>
                <input wire:model="discapacidad" class="with-gap" value="1" {{(old('discapacidad') == 1) ? 'checked' : ''}} name="discapacidad" type="radio" />
                <span>Si</span>
            </label>

            <label>
                <input wire:model="discapacidad" class="with-gap" value="2" {{(old('discapacidad') == 2) ? 'checked' : ''}} name="discapacidad" type="radio" />
                <span>No</span>
            </label> 
            @error('discapacidad') <span class="red-text"> {{$message}}</span> @enderror
        </div>
        <br>
        
        <span class="white-text">Taller:</span> 
        @error('taller') <span class="red-text"> {{$message}}</span> @enderror
        <select name="taller" class=" browser-default grey lighten-2" wire:model="taller">
        <option hidden value=""></option>
        @foreach($talleres as $tallers)
            <option value="{{$tallers->id}}" {{ old('taller') == $tallers->id ? "selected" :""}}>{{$tallers->taller}} {{$tallers->periodo->periodo}}</option>
        @endforeach
        </select>
        <br>

        <div class="modal-footer black">
            <button style="background:#1B396A" type="submit" class="waves-effect waves-light btn-small">Enviar datos<i class="fa-solid fa-paper-plane right" ></i></button>
            
            <button style="background:#BF0820" wire:click="resetInput()" type="button" class="modal-close waves-effect btn-small">Cerrar<i class="fa-solid fa-xmark right"></i></button>
        </div>
        </form>
    </div>
</div>