<div>
    @if(empty($Alumno->taller_id))

        <h6 class="white-text center cuerpo">Inscríbete a uno de los siguientes talleres</h6>

        <p class="white-text center cuerpo">Si no te gustan los deportes no te preocupes, puedes inscribirte a los talleres culturales</p>

        <div class="row">


        @foreach($tallers as $taller)
            <div class="col s12 m6">

                <div class="card medium sticky-action">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="{{$taller->imagen}}" height="200px">
                    </div>

                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"><b>{{$taller->taller}} {{$taller->periodo->periodo}}</b><i class="material-icons right">more_vert</i></span>
                        <p>Descripción: {{ Str::limit ($taller->descripcion, 90)}}</p>
                    </div>

                    <div class="card-action center">
                        <a style="background:#1B396A" class="waves-effect waves-light btn" wire:click="$emit('inscripcion', {{$taller->id}})">¡Inscribirse! <i class="material-icons">create</i></a>
                    </div>

                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4"><b>{{$taller->taller}} {{$taller->periodo->periodo}}</b><i class="material-icons right">close</i></span>
                        <p>Descripción: {{$taller->descripcion}}</p>
                        <p>Horario: {{$taller->horario}}</p>
                        
                        
                        <p>Maestro: {{$taller->maestro->user->name .' '. $taller->maestro->user->last_name}}</p>   
                        
                            
                                
                            
                    </div>
                    
                </div>

            </div>

            

                
            
        @endforeach

        </div>

    @else

        <p class="white-text center cuerpo">Este es el taller al que te inscribiste</p>

    
        <div class="row">
            <div class="col s12 m6">

                <div class="card medium sticky-action">
                    <div class="card-image waves-effect waves-block waves-light">
                        <img class="activator" src="{{$Alumno->taller->imagen}}" height="200px">
                    </div>

                    <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4"><b>{{$Alumno->taller->taller}} {{$Alumno->taller->periodo->periodo}}</b><i class="material-icons right">more_vert</i></span>
                        <p>Descripción: {{ Str::limit ($Alumno->taller->descripcion, 90)}}</p>
                    </div>

                    <div class="card-action center">
                        <a style="color:#B8860B" href="{{route('asistenciaalumno')}}"><i class="material-icons">assignment_turned_in</i>Asistencias</a>
                    </div>

                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4"><b>{{$Alumno->taller->taller}} {{$Alumno->taller->periodo->periodo}}</b><i class="material-icons right">close</i></span>
                        <p>Descripción: {{$Alumno->taller->descripcion}}</p>
                        <p>Horario: {{$Alumno->taller->horario}}</p>
                        
                        
                        <p>Maestro: {{$Alumno->taller->maestro->user->name .' '. $Alumno->taller->maestro->user->last_name}}</p>   
                        
                            
                                
                            
                    </div>
                    
                </div>

            </div>

        </div>
        <br><br>
        <br><br>

        @if (now()->toDateString()>=$Alumno->taller->periodo->fecha_expiracion)
            <a href="/alumno/asistencias" class="btn-flotante">El periodo acabó al fin puedes ir a <br> revisar tu documento de acreditación</a>
        @else
            <a href="/alumno/asistencias" class="btn-flotante">¡Faltan {{$diasDiferencia}} días para que acabe el periodo <br> y puedas descargar tu acreditación!</a>
        @endif

    @endif
</div>
