<?php

namespace App\Http\Middleware;

use App\Models\Asistencia;



use Closure;
use Illuminate\Http\Request;

class AlcanzaAcreditacion
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $alumno=Auth()->user()->alumno;

        if(empty($alumno->taller_id)){
            return redirect('alumno/asistencias');
        }else{

            $asistencias=Asistencia::where('taller_id','=', $alumno->taller_id)->get();
            $f=0;
            $cont=0;
            foreach ($asistencias as $asistencia){
                if ($asistencia->fecha!=$f){
                    $f=$asistencia->fecha;
                    $cont+=1;
                }
            }

            if ($asistencias->count()>=1){
                $f=round($cont*.7);
            }else{
                $f=0; 
            }

            $asistencias2=Asistencia::where('alumno_id','=', $alumno->id)
                                    ->where('af','=',1)->count();


            $asistenciasalum=Asistencia::where('alumno_id','=', $alumno->id)->get();

            if ($asistenciasalum->count()>=1){
                $porcasis=($asistencias2*100)/$cont;
            }else{
                $porcasis=0;
            }

            if (now()->toDateString()>=$alumno->taller->periodo->fecha_expiracion && $asistencias->count()>=1 && $asistencias2>=$f){
                return $next($request);
            }else{
                return redirect('alumno/asistencias');
            }
        }
        
    }
}
