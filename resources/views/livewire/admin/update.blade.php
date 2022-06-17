  
<!-- Modal Structure -->
<div wire:ignore.self id="modal2" class="modal black cuerpo">

    <div class="center">
        <br>
        <img class="circle" src="https://brandem.mx/wp-content/uploads/2018/12/FELINOS_mascota.jpg" width="100px" height="100px">
    </div>

    <div class="modal-content">
        <form wire:submit.prevent="update">
            <input type="hidden"  class="grey lighten-2" wire:model="user_id" >

            <span class="white-text">Nombre(s):</span> 
            @error('name') <span class="red-text"> {{$message}}</span> @enderror
            <input type="text"  class="grey lighten-2" wire:model="name" >
            
            <span class="white-text">Apellido(s):</span> 
            @error('last_name') <span class="red-text">{{$message}}</span> @enderror
            <input type="text"  class="grey lighten-2" wire:model="last_name" >

            <span class="white-text">Correo:</span> 
            @error('email')<span class="red-text">{{$message}}</span> @enderror
            <input disabled type="email"  class="grey lighten-2" wire:model="email" >        
    
            <div class="modal-footer black">
                <button  style="background:#1B396A" type="submit" class="waves-effect waves-light btn-small">Guardar cambios<i class="fa-solid fa-paper-plane right" ></i></button>
                
                <button style="background:#BF0820" wire:click="resetInput()" type="button" class="modal-close waves-effect btn-small">Cerrar<i class="fa-solid fa-xmark right"></i></button>
            </div>
        </form>
    </div>
</div>