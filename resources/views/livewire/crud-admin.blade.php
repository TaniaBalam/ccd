<div>
    
   
    <div class="row">
        <input class="col m3 s6 white" placeholder="Buscar por nombre" type="text" wire:model="buscador">

        <button class="btn color" style="height:45px" wire:click="render()"><i class="fa-solid fa-magnifying-glass"></i></i></button>
    </div>

    @include('livewire.admin.create')
    @include('livewire.admin.update')
    
    <table class="highlight responsive-table titulo">
        
        <thead class="indigo">
           
            <th>Nombre</th>
            <th>Correo institucional</th>
            <th>Acciones</th>                
        </thead>
        
        <tbody class="white">
            <!-- compara si hay usuarios -->
            @if($admins->count() <> 0)
                @foreach($admins as $user)
                
                    <tr> 
                                                                
                        <td >{{$user->name}} {{$user->last_name}}</td>

                        <td >{{$user->email}}</td>
                    
                        <td>  
                            <a style="background:green" class="btn col s12 modal-trigger" href="#modal2" wire:click="edit({{ $user->id }})"><i class="material-icons">edit</i></a>
                            <a style="background:red" class="btn col s12" wire:click="$emit('delete', {{$user->id}}, {{$user->admin->id}})" ><i class="material-icons">delete</i></a>
                        </td>

                    </tr>

                @endforeach

            <!-- mensaje de que no hay usuarios -->
            @else
            
                <tr>
                    <td class="center" colspan="3" rowspan="3">
                        <br>
                        <i class="fa-solid fa-triangle-exclamation">&nbsp No se encontraron datos</i>
                        <br></br>
                    </td>
                </tr>
            @endif         
        </tbody>
    </table>
    <br></br>
    {{$admins->links('vendor.pagination.materializecss')}}
</div>
