<div>
 
    <div class="row">
        
        <div class="col s12 m8 offset-m2 black">

            <!-- muestra el circulo de la imegen  -->
            <div class="center">
                <br>
                <img class="circle" src="{{$urlimagen}}" width="150px" height="150px">
                
                <a style="background:#1B396A" href="#perfil" class="waves-effect waves-light btn-small modal-trigger"><i class="material-icons ">create</i></a>
            </div>

            <!-- carga el comppnete de livewire -->
            @include('livewire.perfil.perfil')

            <form wire:submit.prevent="update">

                <div class="container cuerpo">

                    
                    <input wire:model="idmaestro" id="id" name="id" type="hidden" class="grey lighten-2">

                    <div class="input-field">
                        <span class="white-text"> Nombre(s): </span> 
                        @error('name') <span class="red-text"> {{$message}}</span> @enderror
                        <input wire:model="name" id="nombre" name="nombre" type="text" class="grey lighten-2"  value="{{old('nombre',$maestro->user->name)}}">
                    </div>

                    <div class="input-field">
                        <span class="white-text"> Apellido(s): </span> 
                        @error('last_name') <span class="red-text"> {{$message}}</span> @enderror
                        <input wire:model="last_name" id="apellido" name="apellido" type="text" class="grey lighten-2"  value="{{old('apellido',$maestro->user->last_name)}}">
                    </div>

                    <div class="input-field">
                        <span class="white-text"> Correo institucional: </span> 
                        <input disabled  type="text" class="grey lighten-2"  value="{{$maestro->user->email}}">
                    </div>

                    <div class="input-field">
                        <span class="white-text"> Número de maestro: </span> 
                        <input disabled  type="text" class="grey lighten-2"  value="{{$maestro->numero}}">
                    </div>

                    <div class="center">
                        <button  style="background:#1B396A" type="submit" class="waves-effect waves-light btn-small">Guardar cambios<i class="material-icons right">save</i></button>
                    </div>
                </div>
            </form>
            <br>
        </div>
    </div>

</div>
