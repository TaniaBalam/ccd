<div>

    <div class="row">
        <input class="col m3 s6 white" placeholder="Buscar por taller" type="text" wire:model="buscador">

        <button class="btn color" style="height:45px" wire:click="render()"><i class="fa-solid fa-magnifying-glass"></i></i></button>
    </div>

    @include('livewire.alumno.create')

    <div class="row cuerpo">
        @if($tallers->count() <> 0)
            @foreach($tallers as $taller)
                <div class="col s12 l6">
                    <ul class="collection">
                        <li class="collection-item avatar">
                            <b><span class="title">{{$taller->taller}} {{$taller->periodo->periodo}}</span></b>
                            <img src="{{$taller->imagen}}" alt="" class="circle">
                            <p>Número de alumnos: {{$taller->alumnos->count()}}</p>
                            <br>
                            <p ><a class="color-base cambiar" href="{{route('vistaveralumnosadmin', $taller->id)}}"><i class="material-icons">group</i>Alumnos</a></p>
                            @can('editar alumno') 
                                <p><a class="color-base cambiar" href="{{route('vistaverasis', $taller->id)}}"><i class="material-icons">assignment_turned_in</i>Asistencias</a></p>
                            @endcan

                            <p><a class="color-base cambiar" href="{{route('reporteasistenciaAdmin', $taller->id)}}"><i class="material-icons">event_note</i>Reporte de asistencias</a></p>
                            
                        </li>
                    </ul>
                </div>
            @endforeach
        @else
            
            <div class="center">
                <p class="white-text">No se encontraron talleres</p>
                <img class="circle" width="250px" height="250px" src="https://i0.wp.com/gatolia.com/wp-content/uploads/2021/04/dibujos-animados-lindo-regreso-escuela-gatos-leyendo-libro_39961-1362.jpg?resize=626%2C450&ssl=1">
            </div>

        @endif
    </div>

    {{$tallers->links('vendor.pagination.materializecss')}}

</div>