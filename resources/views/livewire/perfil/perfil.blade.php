
<!-- Modal Structure -->
<div wire:ignore.self id="perfil" class="center modal black cuerpo col s12 m6">

    <h2 class="white-text">Actualizar imagen </h2>

    @if($imagen)
        <div class="center">
            <br>
            <img class="circle" src="{{ $imagen->temporaryUrl() }}" width="100px" height="100px">
        </div>
    @else
        <div class="center">
            <br>
            <img class="circle" src="{{$urlimagen}}"  width="100px" height="100px">
        </div>
    @endif

    <div class="modal-content">
        <form wire:submit.prevent="imgperfil">
            <span class="white-text">Seleccionar imagen:</span> 
            <input class="white" type="file" wire:model="imagen">
            @error('imagen') <span class="red-text">{{$message}}</span> @enderror

            <div class="modal-footer black">
                <br>
                <button style="background:#1B396A" wire:loading.attr="disabled" wire:target="imagen" type="submit" class="waves-effect waves-light btn-small">Actualizar imagen<i class="fa-solid fa-paper-plane right" ></i></button>
            
                <button style="background:#BF0820"  type="button" class="modal-close waves-effect btn-small">Cerrar<i class="fa-solid fa-xmark right"></i></button>
            </div>
            
        </form>
    </div>
</div>