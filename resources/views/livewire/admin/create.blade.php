
  <!-- Modal Trigger -->
  <a style="background:#B8860B" class="btn col s12 modal-trigger" href="#modal1"><i class="material-icons left">person_add</i>Crear administrador</a>
  <br><br>
  
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

        <span class="white-text">Correo:</span> 
        @error('email')<span class="red-text">{{$message}}</span> @enderror
        <input type="email"  class="grey lighten-2" wire:model="email" >

        <span class="white-text">contraseña:</span> 
        @error('password') <span class="red-text">{{$message}}</span> @enderror
        <input type="password"  class="grey lighten-2" wire:model="password" >

        <div>
          <span class="white-text">Rol: </span>
          @error('rol') <span class="alert-danger red-text">{{$message}}</span> @enderror
          <select class="browser-default grey lighten-2" wire:model="rol">
              <option value="" disabled selected></option>
              <option value="1" {{ old('rol') == 1 ? 'selected' : '' }}>Administrador</option>
              <option value="4" {{ old('rol') == 2 ? 'selected' : '' }}>Coordinador</option>
          </select>
          
          
        </div>

        <div class="modal-footer black">
          <button style="background:#1B396A" type="submit" class="waves-effect waves-light btn-small">Enviar datos<i class="fa-solid fa-paper-plane right" ></i></button>
          
          <button style="background:#BF0820" wire:click="resetInput()" type="button" class="modal-close waves-effect btn-small">Cerrar<i class="fa-solid fa-xmark right"></i></button>
        </div>
      </form>
    </div>
  </div>