<div>

    <div class="row">
        <input class="col m3 s6 white" placeholder="Buscar por nombre" type="text" wire:model="buscador">

        <button class="btn color cambiar" style="height:45px" wire:click="render()"><i class="fa-solid fa-magnifying-glass"></i></i></button>
    </div>

    <table class="highlight responsive-table titulo">
                
        <thead class="indigo">
            <th>Nombre</th>
            <th>Correo institucional</th>
            <th>Carrera</th>
            <th>Matrícula</th>
            <th>Municipio</th>                
        </thead>
        
        <tbody class="white">
            @if($alumnos->count() <> 0)
                @foreach($alumnos as $user)
                
                    <tr> 
                        <td>{{$user->name .' '. $user->last_name}}</td>                                           
                        <td>{{$user->email}}</td>
                        <td>{{$user->alumno->carrera}}</td>
                        <td>{{$user->alumno->matricula}}</td>
                        <td>{{$user->alumno->municipio->municipio}}</td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="center" colspan="5">
                        <br>
                        <i class="fa-solid fa-triangle-exclamation">&nbsp No se encontraron datos</i>
                        <br></br>
                    </td>
                </tr>
            @endif            
        </tbody>
    </table>
    <br>
    {{$alumnos->links('vendor.pagination.materializecss')}}
</div>