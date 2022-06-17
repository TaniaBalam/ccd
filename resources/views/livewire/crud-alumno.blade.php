<div>

   
    <div class="row">
        <input class="col m3 s6 white" placeholder="Buscar por nombre" type="text" wire:model="buscador">

        <button class="btn color" style="height:45px" wire:click="render()"><i class="fa-solid fa-magnifying-glass"></i></i></button>
    </div>
    
    @include('livewire.alumno.update')
    
    <table style="font-size:small"class="highlight responsive-table titulo">
        
        <thead class="indigo">
           
            <th>Nombre</th>
            <th>Correo institucional</th>
            <th>Edad</th> 
            <th>Sexo</th> 
            <th>Teléfono</th>
            <th>Carrera</th>
            <th>Matrícula</th>
            <th>Cultura etnia</th>
            <th>Municipio</th>
            <th>Discapacidad</th>
            
            @can('eliminar alumno')
                <th>Acciones</th>
            @endcan   

        </thead>
        
        <tbody class="white">
            <!-- compara si hay usuarios -->
            @if($admins->count() <> 0)
                @foreach($admins as $user)
        
                        <tr>                         
                            <td >{{$user->name}} {{$user->last_name}}</td>
                            <td >{{$user->email}}</td>
                            <td>{{$user->alumno->edad}}</td>
                            <td>{{$user->alumno->sexo}}</td>
                            <td>{{$user->alumno->telefono}}</td>
                            <td>{{$user->alumno->carrera}}</td>
                            <td>{{$user->alumno->matricula}}</td>
                            <td>{{$user->alumno->culturaetnia}}</td>
                            <td>{{$user->alumno->municipio->municipio}}</td>
                            <td>{{$user->alumno->discapacidad}}</td>
                        
                            @can('eliminar alumno')
                                <td>  
                                    <div >
                                        <a style="background:green" class="btn col s12 modal-trigger" href="#modal2" wire:click="edit({{ $user->id }})"><i class="material-icons">edit</i></a>
                                    </div>
                                    <br>
                                    <div>
                                        <a style="background:red" class="btn col s12" wire:click="$emit('delete', {{$user->id}}, {{$user->alumno->id}})" ><i class="material-icons">delete</i></a>
                                    </div>
                                </td>
                            @endcan
                        </tr>
                    
                @endforeach

            <!-- mensaje de que no hay usuarios -->
            @else
                
                <tr>
                    <td class="center" colspan="11" rowspan="3">
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



