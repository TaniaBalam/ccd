
<div>
 
    <div class="row">
        <input class="col m3 s6  white" placeholder="Buscar por periodo" type="text" wire:model="buscador">

        <button class="btn color" style="height:45px" wire:click="render()"><i class="fa-solid fa-magnifying-glass"></i></i></button>
    </div>


    @include('livewire.periodo.create')
    @include('livewire.periodo.update')

    <table class="highlight responsive-table titulo">
        
        <thead class="indigo">
            <th>Periodo</th>
            <th>Fecha de emisión</th>
            <th>Fecha de expiración</th>

            @can('eliminar alumno')
                <th>Acciones</th>
            @endcan
                         
        </thead>
        
        <tbody class="white">
            @if($periodos->count() <> 0)
                @foreach($periodos as $periodo)
                
                    <tr> 
                        <td>{{$periodo->periodo}}</td>     
                        <td>{{$periodo->fecha_emision}}</td>
                        <td>{{$periodo->fecha_expiracion}}</td>                                           
            
                        @can('eliminar alumno')
                            <td>  
                                <a style="background:green" class="btn col s12 modal-trigger" href="#modal2" wire:click="edit({{ $periodo->id }})"><i class="material-icons">edit</i></a>
                                <a style="background:red" class="btn col s12" wire:click="$emit('delete', {{$periodo->id}})"><i class="material-icons">delete</i></a>
                            </td>
                        @endcan
                        
                    </tr>

                @endforeach
            @else
                <tr>
                    <td class="center" colspan="4">
                        <br>
                        <i class="fa-solid fa-triangle-exclamation">&nbsp No se encontraron datos</i>
                        <br></br>
                    </td>
                </tr>
            @endif                
        </tbody>
    </table>
    <br><br>
    {{$periodos->links('vendor.pagination.materializecss')}}
</div>
