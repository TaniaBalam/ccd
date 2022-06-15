@can('editar alumno')
    <a style="background:#B8860B" class="btn col s12 modal-trigger" href="#modal1" ><i class="material-icons left">add_box</i>Crear taller</a>
@endcan


<!-- Modal Structure -->
<div wire:ignore.self id="modal1" class="modal black cuerpo">

    <div class="center">
        <br>
        <img class="circle" src="https://brandem.mx/wp-content/uploads/2018/12/FELINOS_mascota.jpg" width="100px" height="100px">
    </div>

    <div class="modal-content">
        <form wire:submit.prevent="submit">

        <span class="white-text"> Nombre del taller: </span>
        @error('taller') <span class="red-text"> {{$message}}</span> @enderror
        <input wire:model="taller" id="taller" name="taller" type="text" class="grey lighten-2"  value="{{old('taller')}}" autofocus>

        <span class="white-text"> Descripción: </span> 
        @error('descripcion') <span class="red-text"> {{$message}}</span> @enderror
        <textarea wire:model="descripcion" id="descripcion" name="descripcion" cols="30" rows="10" placeholder="En este taller aprenderas..." class="grey lighten-2 largo"></textarea>

        <span class="white-text">Maestro:</span>
        @error('maestro') <span class="red-text"> {{$message}}</span> @enderror
        <select wire:model="maestro" name="maestro" class="browser-default grey lighten-2" >
            <option value="" selected></option>
            
            @foreach($usuarios as $usuario)
                @if ($usuario->hasRole('maestro'))
                    <option value="{{$usuario->maestro->id}}" {{ old('maestro') == $usuario->maestro->id ? "selected" :""}}>{{$usuario->name . ' ' . $usuario->last_name}}</option>
                @endif
            @endforeach
        </select>

        <span class="white-text"> Horario: </span> 
        @error('horario') <span class="red-text"> {{$message}}</span> @enderror
        <input wire:model="horario" id="horario" name="horario" type="text" class="grey lighten-2"  value="{{old('horario')}}">

        <span class="white-text">Periodo:</span>
        @error('periodo') <span class="red-text"> {{$message}}</span> @enderror
        <select wire:model="periodo" name="periodo" class="browser-default grey lighten-2" >
            <option value="" selected></option>
            
            @foreach($periodos as $periodo)
                <option value="{{$periodo->id}}" {{ old('periodo') == $periodo->id ? "selected" :""}}>{{$periodo->periodo}}</option>
            @endforeach
        </select>

        <span class="white-text"> URL de la imagen: </span>
        @error('imagen') <span class="red-text"> {{$message}}</span> @enderror 
        <input wire:model="imagen" id="imagen" name="imagen" type="text" class="grey lighten-2"  value="{{old('imagen')}}">


        <div class="modal-footer black">
            <button style="background:#1B396A" type="submit" class="waves-effect waves-light btn-small">Enviar datos<i class="fa-solid fa-paper-plane right" ></i></button>
            
            <button style="background:#BF0820" wire:click="resetInput()" type="button" class="modal-close waves-effect btn-small">Cerrar<i class="fa-solid fa-xmark right"></i></button>
        </div>
        </form>
    </div>
</div>