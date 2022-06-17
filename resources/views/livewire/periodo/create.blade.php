@can('editar alumno')
    <a style="background:#B8860B" class="btn col s12 modal-trigger" href="#modal1"><i class="material-icons left">add_box</i>Crear periodo</a>
    <br></br>
@endcan


<!-- Modal Structure -->
<div wire:ignore.self id="modal1" class="modal black cuerpo">

    <div class="center">
        <br>
        <img class="circle" src="https://brandem.mx/wp-content/uploads/2018/12/FELINOS_mascota.jpg" width="100px" height="100px">
    </div>

    <div class="modal-content">
        <form wire:submit.prevent="submit">

        <span class="white-text"> Periodo: </span> 
        @error('periodo') <span class="red-text"> {{$message}}</span> @enderror
        <input wire:model="periodo" id="periodo" name="periodo" type="text" class="grey lighten-2"  value="{{old('periodo')}}" autofocus>

        <span class="white-text"> Fecha de emisión: </span> 
        @error('fechaemision') <span class="red-text"> {{$message}}</span> @enderror
        <input wire:model="fechaemision" name="fechaemision" id="fechaemision" type="date" class="grey lighten-2" value="{{old('fechaemision')}}">

        <span class="white-text"> Fecha de expiración: </span> 
        @error('fechaemision') <span class="red-text"> {{$message}}</span> @enderror
        <input wire:model="fechaexpiracion" name="fechaexpiracion" id="fechaexpiracion" type="date" class="grey lighten-2" value="{{old('fechaexpiracion')}}">
 
        <div class="modal-footer black">
            <button style="background:#1B396A" type="submit" class="waves-effect waves-light btn-small">Enviar datos<i class="fa-solid fa-paper-plane right" ></i></button>
            
            <button style="background:#BF0820" wire:click="resetInput()" type="button" class="modal-close waves-effect btn-small">Cerrar<i class="fa-solid fa-xmark right"></i></button>
        </div>
        </form>
    </div>
</div>