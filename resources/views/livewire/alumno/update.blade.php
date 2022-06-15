    
<!-- Modal Structure -->
<div wire:ignore.self id="modal2" class="modal black cuerpo">

    <div class="center">
        <br>
        <img class="circle" src="https://brandem.mx/wp-content/uploads/2018/12/FELINOS_mascota.jpg" width="100px" height="100px">
    </div>

    <div class="modal-content">
        <form wire:submit.prevent="update">
            <input type="hidden"  class="grey lighten-2" wire:model="user_id" >

            <span class="white-text">Taller:</span> 
            <select name="taller" class=" browser-default grey lighten-2" wire:model="tallers">
                <option hidden >{{$tallers}}</option>
                @foreach($taller as $tallers)
                    <option value="{{$tallers->id}}" {{ old('taller') == $tallers->id ? "selected" :""}}>{{$tallers->taller}} {{$tallers->periodo->periodo}}</option>
                @endforeach
            </select>
            <br>

            <span class="white-text">Nombre(s):</span> 
            @error('name') <span class="red-text"> {{$message}}</span> @enderror
            <input type="text"  class="grey lighten-2" wire:model="name" >
            
            <span class="white-text">Apellido(s):</span> 
            @error('last_name') <span class="red-text">{{$message}}</span> @enderror
            <input type="text"  class="grey lighten-2" wire:model="last_name" >

            <span class="white-text">Correo institucional:</span> 
            @error('email')<span class="red-text">{{$message}}</span> @enderror
            <input disabled type="email"  class="grey lighten-2" wire:model="email" >  

            <span class="white-text">Matrícula:</span> 
            @error('matricula')<span class="red-text">{{$message}}</span> @enderror
            <input disabled type="text"  class="grey lighten-2" wire:model="matricula" > 
            <br>

            <span class="white-text">Edad:</span> 
            @error('edad')<span class="red-text">{{$message}}</span> @enderror
            <input type="number"  class="grey lighten-2" wire:model="edad" >
            <br><br>
            
            <div>
                <span class="white-text">Sexo:</span>         
                <label >
                    <input wire:click="opcion('Masculino')" class="with-gap" value="1" @if($sexo == 'Masculino') checked  @endif  {{(old('sexo') == 1) ? 'checked' : ''}} name="sexo" type="radio" />
                    <span>Masculino</span>
                </label>
            

                <label> 
                    <input wire:click="opcion('Femenino')" class="with-gap" value="2" @if($sexo == 'Femenino') checked  @endif  {{(old('sexo') == 2) ? 'checked' : ''}} name="sexo" type="radio" />
                    <span>Femenino</span>
                </label> 
            </div>
            <br>

            <span class="white-text">Teléfono:</span>
            @error('telefono')<span class="red-text">{{$message}}</span> @enderror 
            <input type="number"  class="grey lighten-2" wire:model="telefono" > 

            <span class="white-text">Carrera</span>
            <select wire:model="carrera" name="carrera" class="browser-default grey lighten-2">

                @if($carrera == 'Ingeniería en Sistemas Computacionales')
                    <option hidden value="1" selected >Ingeniería en Sistemas Computacionales</option>
                @endif
                @if($carrera == 'Ingeniería Industrial')
                    <option hidden value="2" selected>Ingeniería Industrial</option>
                @endif
                @if($carrera == 'Ingeniería Electrónica') 
                    <option hidden value="3" selected>Ingeniería Electrónica</option>
                @endif

                @if($carrera == 'Ingeniería en Energías Renovables') 
                    <option hidden value="4" selected>Ingeniería en Energías Renovables</option>
                @endif  

                @if($carrera == 'Ingeniería Electromécanica') 
                    <option hidden value="5" selected>Ingeniería Electromécanica</option>
                @endif

                <option wire:click="opcion2('1')" value="1" {{ old('carrera') == 1 ? 'selected' : '' }}>Ingeniería en Sistemas Computacionales</option>
                <option wire:click="opcion2('2')" value="2" {{ old('carrera') == 2 ? 'selected' : '' }}>Ingeniería Industrial</option>
                <option wire:click="opcion2('3')" value="3" {{ old('carrera') == 3 ? 'selected' : '' }}>Ingeniería Electrónica</option>
                <option wire:click="opcion2('4')" value="4" {{ old('carrera') == 4 ? 'selected' : '' }}>Ingeniería en Energías Renovables</option>
                <option wire:click="opcion2('5')" value="5" {{ old('carrera') == 5 ? 'selected' : '' }}>Ingeniería Electromécanica</option>
            </select>
            <br>

            <div>
            <span class="white-text">Cultura etnia:</span>            
            <label>
                <input wire:click="opcion3('Si')" class="with-gap" value="1" @if($cultura == 'Si') checked  @endif  {{(old('culturaetnia') == 1) ? 'checked' : ''}} name="culturaetnia" type="radio" />
                <span>Si</span>
            </label>
           
            <label>
                <input wire:click="opcion3('No')" class=" with-gap" value="2" @if($cultura == 'No') checked  @endif  {{(old('culturaetnia') == 2) ? 'checked' : ''}} name="culturaetnia" type="radio" />
                <span>No</span>
            </label> 
            </div>
            <br>

            <span class="white-text">Municipio:</span>
            <select wire:model="muni" name="municipio" class="browser-default grey lighten-2" >
                <option hidden>{{$muni}}</option>
                @foreach($municipio as $municipios)
                    <option value="{{$municipios->id}}" {{ old('municipio') == $municipios->id ? "selected" :""}}>{{$municipios->municipio}}</option>
                @endforeach
            </select>
            <br>

            <div>
            <span class="white-text">Discapacidad:</span>                
            <label>
                <input wire:click="opcion4('Si')" class="with-gap" value="1" @if($discapacidad == 'Si') checked  @endif  {{(old('discapacidad') == 1) ? 'checked' : ''}} name="discapacidad" type="radio" />
                <span>Si</span>
            </label>
            
            <label>
                <input wire:click="opcion4('No')" class="with-gap" value="2" @if($discapacidad == 'No') checked  @endif  {{(old('discapacidad') == 2) ? 'checked' : ''}} name="discapacidad" type="radio" />
                <span>No</span>
            </label>
            </div> 

            <div class="modal-footer black">
                <button  style="background:#1B396A" type="submit" class="waves-effect waves-light btn-small">Guardar cambios<i class="material-icons left">save</i></button>
                
                <button style="background:#BF0820" wire:click="resetInput()" type="button" class="modal-close waves-effect btn-small">Cerrar<i class="fa-solid fa-xmark right"></i></button>
            </div>
        </form>
    </div>
</div>