<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rules;

use Illuminate\Http\Request;
use App\Models\Alumno;//
use App\Models\Taller; //
use App\Models\Periodo;//
use App\Models\Asistencia;//
use App\Models\Admin;//

class AdminController extends Controller
{

// ---------------------------------------------------------------------------------------------------------------------------
// ------------------------------------------------------- utilizados  -------------------------------------------------------
// ---------------------------------------------------------------------------------------------------------------------------

    public function vistaverasis($id){
        $tallers=Taller::findOrFail($id);
        $alumnos = $tallers->alumnos;
        return view('asistencias2admin' , ['alumnos' => $alumnos, 'tallers' => $tallers, 'id' => $id]); 
    }

    //componente
    public function vistaadmins(){
        $admins=Admin::All();
        return view('vistaadmins' , ['admins' => $admins]);
    }

    //componente
    public function editadmin(){ 
        return view('actualizaradmin'); 
    }

    //componente
    public function vistaperiodos(){
        $periodos=Periodo::Paginate(15);
        return view('periodosadmin' , ['periodos' => $periodos]);
    }

    //componente
    public function vistaalumnos(){
        return view('alumnosadmin');
    }
    
    //componente
    public function vistaveralumnos($id){
        $tallers=Taller::findOrFail($id);
        $alumnos = $tallers->alumnos;
        return view('alumnos2admin' , ['alumnos' => $alumnos, 'tallers' => $tallers, 'idtaller'=>$id]);
        
    }

    //componentes
    public function vistamaestro(){
        return view('maestrosadmin');
    }

    //componente
    public function vistataller2(){
        return view('talleresadmin');
    }


    public function admininicio(){

        $periodo = Periodo::All()->last()->periodo;
        $periodo2 = Periodo::All()->last()->id;
    
        $tallers = Taller::where("periodo_id","=",$periodo2)->get();

    
        //cargar cuantos talleres existen
        $data = [];
        foreach($tallers as $taller){
            $data[] = $taller->taller;
        }

        $c = [];
        foreach($tallers as $taller){
            $c[]+=Alumno::where("taller_id", "=",$taller->id)
                            ->count();
        }

        //contar numero de alumnos registrados  con cultura etnia en cada taller
        $data2 = [];
        foreach($tallers as $taller){
            $data2[]+= Alumno::where("taller_id","=",$taller->id)
                                ->where("culturaetnia","=",1)
                                ->count();
        }

        //contar numero de alumnos registrados con discapacidad en cada taller
        $data3 = [];
        foreach($tallers as $taller){
            $data3[]+= Alumno::where("taller_id","=",$taller->id)
                                ->where("discapacidad","=",1)
                                ->count();
        }

        //contar genero en cada taller
        $mujeres = [];
        $hombres = [];
        foreach($tallers as $taller){
            $mujeres[]+= Alumno::where("taller_id","=",$taller->id)
                                ->where("sexo","=",2)
                                ->count();

            $hombres[]+= Alumno::where("taller_id","=",$taller->id)
                                ->where("sexo","=",1)
                                ->count();
        }

       
        return view('gestionadmin' , ['c' => $c, 'data' => $data, 'data2' => $data2, 'data3' => $data3, 'tallers' => $tallers, 'h'=> $hombres, 'm'=> $mujeres,'periodo'=> $periodo]);
    }

    public function updateasisAdmin(Request $request){
            
        foreach($request->get('asistencia') as $key => $value){
            $asistencia=Asistencia::find($request->get('idAsistencia')[$key]);
            $asistencia->af = $value;
            $taller=$asistencia->taller_id;
            $asistencia->save();  
        }

        return redirect('/admin/taller/editasistencias/'.$taller)->with('success', 'Asistencias actualizadas correctamente');              
    }

    public function editarasistenciasAdmin($id){
        $tallers=Taller::findOrFail($id);
        $asistencias=Asistencia::where('taller_id','=', $id)->orderBy('fecha','desc')->get();

        return view('editarasistenciasAdmin' , ['tallers'=> $tallers, 'asistencias'=> $asistencias, 'id' => $id]);
    }

    public function enviarAsistenciaAdmin(Request $request){

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

            return redirect('/admin/taller/asistencias/'.$request->taller)->with('success', 'Asistencias aplicadas correctamente');

        }else{
            return redirect('/admin/taller/asistencias/'.$request->taller)->with('error', 'No se puede registrar más de una asistencia por día');
        }
   
    }

    public function reporteasistenciaAdmin($id){
        $tallers=Taller::findOrFail($id);
        $alumnos = $tallers->alumnos;

        $f=0;
        $asistencias = Asistencia::distinct('fecha')->where('taller_id','=',$tallers->id)->count();

        if ($asistencias>=1){
            $f=round($asistencias*.7);
        }else{
            $f=0; 
        }

        return view('reporteasisAdmin' , ['f' => $f, 'alumnos'=> $alumnos,'asistencias'=> $asistencias, 'tallers'=> $tallers]);
    }

}
