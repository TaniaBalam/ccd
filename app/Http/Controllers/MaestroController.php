<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Taller;
use App\Models\Maestro;
use App\Models\User;
use App\Models\Periodo;
use App\Models\Asistencia;

class MaestroController extends Controller
{
    //

    public function crear(){
        $taller=Taller::All();
        return view('crearmaestro', ['taller' => $taller]);
    }


    public function store(Request $request){
            
        $validated = $request->validate([
            'numero'=>'required|unique:maestros|min:4|max:4|regex:/[0-9]/',    
        ]);
        

        $Maestro= new Maestro;
        $Maestro->numero = $request->numero;
        $Maestro->user_id=Auth()->user()->id;
        

        $maestros = Maestro::where("user_id","=",Auth()->user()->id)->get();

    
        if($maestros->count() == 0){
            
            $Maestro->save();
            return redirect('/maestro/taller');   
            
        }else{
            return redirect('/maestro/crear')->with('error', 'Ya ha registrado sus datos');
        }


                   
    }

    public function vistaalumnos2(){
        $periodo = Periodo::All()->last()->periodo;
        $periodo2 = Periodo::All()->last()->id;
        $tallers=Taller::where("periodo_id","=",$periodo2)->where("maestro_id", "=", Auth()->user()->maestro->id)->get();
        return view('alumnosmaestro' , ['tallers' => $tallers]);
    }

    
    public function vistaveralumnos2($id){
        $tallers=Taller::findOrFail($id);
        $alumnos = $tallers->alumnos;

        $this->authorize('vistaveralumnos2', $tallers);
        
        return view('alumnos2maestro' , ['alumnos' => $alumnos, 'tallers' => $tallers]);
        
    }

    public function edit(){
        $maestros = Auth()->user()->maestro;
        return view('actualizarmaestro', ['maestros' => $maestros]);
        
    }

    public function update(Request $request, $id){
            
        $validated = $request->validate([
            'nombre'=>'required|min:2|max:50',
            'apellido'=>'required|min:2|max:50',
        ]);
        
        $maestros = Maestro::findOrFail($id);
        $usuarios=User::findOrFail($maestros->user->id);
        $usuarios->name= $request->nombre;
        $usuarios->last_name= $request->apellido;
        $usuarios->save();

        return redirect('/maestro/taller');              
    }



    public function asistencias($id){
        $tallers=Taller::findOrFail($id);
        $alumnos = $tallers->alumnos;

        $this->authorize('asistencias', $tallers);
        
        return view('asistenciasmaestro' , ['alumnos' => $alumnos, 'tallers' => $tallers, 'id' => $id]);
        
    }

    
    public function enviarAsistencia(Request $request){

        $validated = $request->validate([
            'fecha'=>'required',
        ]);
        
        $asistencias = Asistencia::where("taller_id","=",$request->taller)->get();
        $hayfecha = 0;

        foreach($asistencias as $asistencia){
            if($asistencia->fecha ==  $request->fecha){
                $hayfecha += 1;
            }
        }

        if($hayfecha === 0){
            foreach($request->get('asistencia') as $key => $value){
                $asistencia= new Asistencia;
                $asistencia->fecha = $request->get('fecha');
                $asistencia->af = $value;
                $asistencia->taller_id = $request->get('tallerid')[$key];
                $asistencia->alumno_id = $request->get('alumnoid')[$key];
                $asistencia->save();  
            }

            return redirect('/maestro/asistencias/'.$request->taller)->with('success', 'Asistencias aplicadas correctamente');

        }else{
            return redirect('/maestro/asistencias/'.$request->taller)->with('error', 'No se puede registrar m??s de una asistencia por d??a');
        }
   
    }


    public function reporteasistencia($id){
        $tallers=Taller::findOrFail($id);
        $alumnos = $tallers->alumnos;
        $f=0;
        $asistencias = Asistencia::distinct('fecha')->where('taller_id','=',$tallers->id)->count();

        if ($asistencias>=1){
            $f=round($asistencias*.7);
        }else{
            $f=0; 
        }

        $this->authorize('reporteasistencia', $tallers);
        
        return view('reporteasismaestro' , ['f' => $f, 'alumnos'=> $alumnos, 'asistencias'=> $asistencias]);
    }


    public function editarasistencias($id){
        $tallers=Taller::findOrFail($id);
        $asistencias=Asistencia::where('taller_id','=', $id)->orderBy('fecha','desc')->get();

        $this->authorize('editarasistencias', $tallers);

        return view('editarasistenciasmaestro' , ['tallers'=> $tallers, 'asistencias'=> $asistencias, 'id' => $id]);
    }


    public function updateasis(Request $request){
            
        foreach($request->get('asistencia') as $key => $value){
            $asistencia=Asistencia::find($request->get('idAsistencia')[$key]);
            $asistencia->af = $value;
            $taller=$asistencia->taller_id;
            $asistencia->save();  
        }

        return redirect('/maestro/asistencias/editasistencias/'.$taller);              
    }




    

}
