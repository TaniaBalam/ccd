

<div>

    
    <div class="row">
        <input class="col m3 s6 white" placeholder="Buscar por taller" type="text" wire:model="buscador">

        <button class="btn color" style="height:45px" wire:click="render()"><i class="fa-solid fa-magnifying-glass"></i></i></button>
    </div>
    
    @include('livewire.taller.create')
    @include('livewire.taller.update')

    <br><br>

    <table class="highlight responsive-table titulo">
        
        <thead class="indigo">
            <th>Taller</th>
            <th>Descripción</th>
            <th>Maestro</th>
            <th>Horario</th>
            <th>Periodo</th>

            @can('eliminar alumno')
                <th>Acciones</th>
            @endcan
           
            
                            
        </thead>
        
        <tbody class="white">
            @if($tallers->count() <> 0)
                @foreach($tallers as $taller)
                
                    <tr> 
                        <td>{{$taller->taller}}</td>                                           
                        <td>{{$taller->descripcion}}</td>
                        @if (empty($taller->maestro->user->name))
                            <td>Sin maestro</td>
                        @else
                            <td>{{$taller->maestro->user->name .' '. $taller->maestro->user->last_name}}</td>   
                        @endif

                        <td>{{$taller->horario}}</td>
                        <td>{{$taller->periodo->periodo}}</td>
                    
                        @can('eliminar alumno')
                            <td>  
                                <div>
                                    <a style="background:green" class="btn col s12 modal-trigger" href="#modal2" wire:click="edit({{ $taller->id }})"><i class="material-icons">edit</i></a>
                                </div>
                                <br>
                                <div>
                                    <a style="background:red" class="btn col s12" wire:click="$emit('delete', {{$taller->id}})"><i class="material-icons">delete</i></a>
                                </div>
                            </td>
                        @endcan
                        
                    </tr>

                @endforeach
            <!-- mensaje de que no hay talleres -->
            @else
                
                <tr>
                    <td class="center" colspan="6">
                        <br>
                        <i class="fa-solid fa-triangle-exclamation">&nbsp No se encontraron datos</i>
                        <br></br>
                    </td>
                </tr>

            @endif
                        
        </tbody>
    </table>
    <br><br>

 
    {{$tallers->links('vendor.pagination.materializecss')}}
</div>
