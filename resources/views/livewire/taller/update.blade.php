    
<!-- Modal Structure -->
<div wire:ignore.self id="modal2" class="modal black cuerpo">

    <div class="center">
        <br>
        <img class="circle" src="https://brandem.mx/wp-content/uploads/2018/12/FELINOS_mascota.jpg" width="100px" height="100px">
    </div>

    <div class="modal-content">
        <form wire:submit.prevent="update">
            <input type="hidden"  class="grey lighten-2" wire:model="taller_id" >

            <span class="white-text"> Nombre del taller: </span>
            @error('taller') <span class="red-text"> {{$message}}</span> @enderror
            <input wire:model="taller" id="taller" name="taller" type="text" class="grey lighten-2"  value="{{old('taller')}}" autofocus>

            <span class="white-text"> Descripción: </span> 
            @error('descripcion') <span class="red-text"> {{$message}}</span> @enderror
            <textarea wire:model="descripcion" id="descripcion" name="descripcion" cols="30" rows="10" placeholder="En este taller aprenderas..." class="grey lighten-2 largo"></textarea>

            <span class="white-text">Maestro:</span>
            @error('maestro') <span class="red-text"> {{$message}}</span> @enderror
            <select wire:model="maestro" name="maestro" class="browser-default grey lighten-2" >

                
                @foreach($usuarios as $usuario)
                    @if ($usuario->hasRole('maestro') and $maestro == $usuario->name)
                        <option hidden value="">{{$usuario->name . ' ' . $usuario->last_name}}</option>
                    @endif
                @endforeach
               
                
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
                 
              
                @foreach($periodos as $p)
                    @if($p->periodo == $periodo)
                        <option hidden value="" >{{$p->periodo}}</option>
                    @endif
                @endforeach

                @foreach($periodos as $periodo)
                    <option value="{{$periodo->id}}" {{ old('periodo') == $periodo->id ? "selected" :""}}>{{$periodo->periodo}}</option>
                @endforeach
            </select>

            <span class="white-text"> URL de la imagen: </span>
            @error('imagen') <span class="red-text"> {{$message}}</span> @enderror 
            <input wire:model="imagen" id="imagen" name="imagen" type="text" class="grey lighten-2"  value="{{old('imagen')}}">

            <div class="modal-footer black">
                <button  style="background:#1B396A" type="submit" class="waves-effect waves-light btn-small">Guardar cambios<i class="material-icons left">save</i></button>
                
                <button style="background:#BF0820" wire:click="resetInput()" type="button" class="modal-close waves-effect btn-small">Cerrar<i class="fa-solid fa-xmark right"></i></button>
            </div>
        </form>
    </div>
</div>