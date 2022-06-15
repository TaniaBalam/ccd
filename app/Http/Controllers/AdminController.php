<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\Alumno;
use App\Models\Taller;
use App\Models\User;
use App\Models\Maestro;
use App\Models\Periodo;
use App\Models\Asistencia;
use App\Models\Model_has_role;
use App\Models\Admin;



class AdminController extends Controller
{

    public function vistataller2(){
        $tallers=Taller::Paginate(15);
        return view('talleresadmin' , ['tallers' => $tallers]);
    }

    public function creartaller(){
        $taller=Taller::All();
        $usuarios=User::All();
        $periodos=Periodo::All();
        return view('creartaller' , ['taller' => $taller, 'usuarios' => $usuarios, 'periodos' => $periodos]);
    }

    public function store(Request $request){
            
        $validated = $request->validate([
            'taller'=>'required|min:2|max:45',
            'descripcion'=>'required|min:5|max:500',
            'maestro'=>'required',
            'horario'=>'required|min:5|max:250',
            'periodo'=>'required',
            'imagen'=>'required|url',
        ]);
         

        $taller= new Taller;
        $taller->taller = $request->taller;
        $taller->descripcion = $request->descripcion;
        $taller->maestro_id = $request->maestro;
        $taller->horario = $request->horario;
        $taller->periodo_id = $request->periodo;
        $taller->imagen = $request->imagen;
        $taller->save();

        return redirect('/admin/talleres');              
    }


    public function edit($id){
        $taller = Taller::findOrFail($id);
        $usuarios=User::All();
        $periodos=Periodo::All();
        return view('actualizartaller', ['taller' => $taller,'usuarios' => $usuarios, 'periodos' => $periodos]);
        
    }


    public function update(Request $request, $id){
            
        $validated = $request->validate([
            'taller'=>'required|min:2|max:45',
            'descripcion'=>'required|min:5|max:500',
            'maestro'=>'required',
            'horario'=>'required|min:5|max:250',
            'periodo'=>'required',
            'imagen'=>'required|url',
        ]);
         

        $taller=Taller::findOrFail($id);
        $taller->taller = $request->taller;
        $taller->descripcion = $request->descripcion;
        $taller->maestro_id = $request->maestro;
        $taller->horario = $request->horario;
        $taller->periodo_id = $request->periodo;
        $taller->imagen = $request->imagen;
        $taller->save();

        return redirect('/admin/talleres');              
    }

    public function vistamaestro(){
        $maestros=Maestro::All();
        $tallers=Taller::All();
        return view('maestrosadmin' , ['maestros' => $maestros, 'tallers' => $tallers]);
    }


    public function edit2($id){
        $maestros = Maestro::findOrFail($id);
        return view('actualizarmaestroadmin', ['maestros' => $maestros]);
        
    }

    public function update2(Request $request, $id){
            
        $validated = $request->validate([
            'nombre'=>'required|min:2|max:50',
            'apellido'=>'required|min:2|max:50',
        ]);
        
        $maestros = Maestro::findOrFail($id);
        $usuarios=User::findOrFail($maestros->user->id);
        $usuarios->name= $request->nombre;
        $usuarios->last_name= $request->apellido;
        $usuarios->save();

        return redirect('/admin/maestros');              
    }

    public function crear2(){
        
        return view('crearmaestroadmin');
    }


    public function store2(Request $request){
            
        $validated = $request->validate([
            'nombre'=>'required|string|max:255',
            'apellido'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users|regex:/^[a-z]{2,20}\.[a-z]{2,20}@itsmotul.edu.mx$/',
            'password' => 'required','confirmed', Rules\Password::defaults(),
            'numero'=> 'required|unique:maestros|min:4|max:4|regex:/[0-9]/',
        ]);
         
        $rol='maestro';
        
        $user=new User;
        $user->name= $request->nombre;
        $user->last_name= $request->apellido;
        $user->email= $request->email;
        $user->password= Hash::make($request->password);
        $user->rol=$rol;
        $user->save();

        $hasrole = New Model_has_role;
        $hasrole->role_id= 3;
        $hasrole->model_type='App\Models\User';
        $hasrole->model_id=$user->id;
        $hasrole->save();
            
        $Maestro= new Maestro;
        $Maestro->numero = $request->numero;
        $Maestro->user_id=$user->id;
        $Maestro->save();

        return redirect('/admin/maestros');              
    }


    public function destroyemaestro($id, $id2)
    {

        $maestro=Maestro::findOrFail($id);
        $user=User::findOrFail($id2);
        $tallers = Taller::where("maestro_id","=",$maestro->id)->get();

    
        if($tallers->count() == 0){
            
            $modelhasroles = Model_has_role::where("model_id","=",$user->id)->delete();
            $maestro->delete();
            $user->delete();
            return redirect('/admin/maestros');
            
        }else{
            return redirect('/admin/maestros')->with('error', 'No se puede eliminar a este maestro por que imparte algun taller');
        }
        
        
    
    }




    public function vistaalumnos(){
        $tallers=Taller::Paginate(12);
        return view('alumnosadmin' , ['tallers' => $tallers]);
    }

    //Read
    public function vistaveralumnos($id){
        $tallers=Taller::findOrFail($id);
        $alumnos = $tallers->alumnos;
        
        return view('alumnos2admin' , ['alumnos' => $alumnos, 'tallers' => $tallers]);
        
    }

    //Update
    public function edit3($id){
        $Alumno = Alumno::findOrFail($id);
        $municipio=Municipio::All();
        $taller=Taller::All();
        return view('actualizaralumnoadmin', ['Alumno' => $Alumno, 'municipio' => $municipio, 'taller' => $taller]);
    }

    public function update3(Request $request , $id){

        $validated = $request->validate([
            'nombre'=>'required|min:2|max:50',
            'apellido'=>'required|min:2|max:50',
            'edad'=>'required|max:2',
            'sexo'=>'required|in:1,2',
            'telefono'=>'required|max:10|regex:/[0-9]/',
            'carrera'=>'required',
            'municipio'=>'required',
            'taller'=>'required',
            'culturaetnia'=>'required|in:1,2',
            'discapacidad'=>'required|in:1,2',
        ]);
        
        $Alumno=Alumno::findOrFail($id);
        $Alumno->edad = $request->edad;
        $Alumno->sexo = $request->sexo;
        $Alumno->telefono = $request->telefono;
        $Alumno->carrera = $request->carrera;
        $Alumno->municipio_id = $request->municipio;
        $Alumno->culturaetnia = $request->culturaetnia;
        $Alumno->discapacidad = $request->discapacidad;
        $Alumno->taller_id = $request->taller;
        $Alumno->save();

        $user=User::findOrFail($Alumno->user->id);
        $user->name= $request->nombre;
        $user->last_name= $request->apellido;
        $user->save();

        return redirect('/admin/taller/alumnos/'.$request->taller);
    }

    //Create
    public function crear3(){
        $municipio=Municipio::All();
        $taller=Taller::All();
        return view('crearalumnoadmin' , ['municipio' => $municipio, 'taller' => $taller]);
    }


    public function store3(Request $request){
            
        $validated = $request->validate([
            'nombre'=>'required|string|max:255',
            'apellido'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users|regex:/^[a-z]{2,20}\.[0-9]{8}@itsmotul.edu.mx$/',
            'password' => 'required','confirmed', Rules\Password::defaults(),
            'edad'=>'required|max:2',
            'sexo'=>'required|in:1,2',
            'telefono'=>'required|max:10|regex:/[0-9]/',
            'carrera'=>'required',
            'municipio'=>'required',
            'culturaetnia'=>'required|in:1,2',
            'discapacidad'=>'required|in:1,2',
            'taller'=>'required',
        ]);
         
        $rol='alumno';
        
        $user=new User;
        $user->name= $request->nombre;
        $user->last_name= $request->apellido;
        $user->email= $request->email;
        $user->password= Hash::make($request->password);
        $user->rol=$rol;
        $user->save();

        $hasrole = New Model_has_role;
        $hasrole->role_id= 2;
        $hasrole->model_type='App\Models\User';
        $hasrole->model_id=$user->id;
        $hasrole->save();


        $cadena = $user->email;

        $separador = '@';
        $separada = explode($separador, $cadena);

        $cadena2 = $separada[0];

        $separador2 = '.';
        $separada2 = explode($separador2, $cadena2);

        $mat=$separada2[1];

        
        $Alumno= new Alumno;
        $Alumno->edad = $request->edad;
        $Alumno->sexo = $request->sexo;
        $Alumno->telefono = $request->telefono;
        $Alumno->carrera = $request->carrera;
        $Alumno->matricula = $mat;
        $Alumno->municipio_id = $request->municipio;
        $Alumno->culturaetnia = $request->culturaetnia;
        $Alumno->discapacidad = $request->discapacidad;
        $Alumno->user_id=$user->id;
        $Alumno->taller_id=$request->taller;
        
        $Alumno->save();

        return redirect('/admin/taller/alumnos/'.$request->taller);              
    }

    //Delete
    public function destroye3($id, $id2)
    {

        $alumno=Alumno::findOrFail($id);
        $user=User::findOrFail($id2);
        $asistencias = Asistencia::where("alumno_id","=",$alumno->id)->get();
        $modelhasroles = Model_has_role::where("model_id","=",$user->id)->delete();
        
        if($asistencias->count() <> 0){
            
            $asistencias->each->delete();

        }

        
        $taller=$alumno->taller_id;
        $alumno->delete();
        $user->delete();
        
        return redirect('/admin/taller/alumnos/'.$taller);
    
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

       
        return view('gestionadmin' , ['c' => $c, 'data' => $data, 'data2' => $data2, 'data3' => $data3, 'tallers' => $tallers, 'h'=> $hombres, 'm'=> $mujeres]);
    }


    public function vistaperiodos(){
        $periodos=Periodo::Paginate(15);
        return view('periodosadmin' , ['periodos' => $periodos]);
    }

    public function crearperiodos(){
        return view('crearperiodo');
    }

    public function storeperiodos(Request $request){
            
        $validated = $request->validate([
            'periodo'=>  ['required', 'regex:/^20[0-9]{2}A|B$/'],
            'fechaemision'=>'required',
            'fechaexpiracion'=>'required|after_or_equal:fechaemision',
        ]);
         

        $periodo= new Periodo;
        $periodo->periodo = $request->periodo;
        $periodo->fecha_emision = $request->fechaemision;
        $periodo->fecha_expiracion = $request->fechaexpiracion;
        $periodo->save();

        return redirect('/admin/periodos');              
    }

    public function editperiodos($id){
        $periodo = Periodo::findOrFail($id);
        return view('actualizarperiodo', ['periodo' => $periodo]);
        
    }


    public function updateperiodos(Request $request, $id){
            
        $validated = $request->validate([
            'periodo'=>  ['required', 'regex:/^20[0-9]{2}A|B$/'],
            'fechaemision'=>'required',
            'fechaexpiracion'=>'required|after_or_equal:fechaemision',
        ]);
         

        $periodo=Periodo::findOrFail($id);
        $periodo->periodo = $request->periodo;
        $periodo->fecha_emision = $request->fechaemision;
        $periodo->fecha_expiracion = $request->fechaexpiracion;
        $periodo->save();

        return redirect('/admin/periodos');              
    }


    public function editadmin(){
        $admin = Auth()->user();
        return view('actualizaradmin', ['admin' => $admin]);
        
    }

    public function updateadmin(Request $request, $id){
            
        $validated = $request->validate([
            'nombre'=>'required|min:2|max:50',
            'apellido'=>'required|min:2|max:50',
        ]);
        
        $admin = User::findOrFail($id);
        $admin->name= $request->nombre;
        $admin->last_name= $request->apellido;
        $admin->save();

        return redirect('/adminperfil/edit');              
    }


    //Read
    public function vistaverasis($id){
        $tallers=Taller::findOrFail($id);
        $alumnos = $tallers->alumnos;
        return view('asistencias2admin' , ['alumnos' => $alumnos, 'tallers' => $tallers, 'id' => $id]); 
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

    public function editarasistenciasAdmin($id){
        $tallers=Taller::findOrFail($id);
        $asistencias=Asistencia::where('taller_id','=', $id)->orderBy('fecha','desc')->get();

        return view('editarasistenciasAdmin' , ['tallers'=> $tallers, 'asistencias'=> $asistencias, 'id' => $id]);
    }


    public function updateasisAdmin(Request $request){
            
        foreach($request->get('asistencia') as $key => $value){
            $asistencia=Asistencia::find($request->get('idAsistencia')[$key]);
            $asistencia->af = $value;
            $taller=$asistencia->taller_id;
            $asistencia->save();  
        }

        return redirect('/admin/taller/editasistencias/'.$taller);              
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

        return view('reporteasisAdmin' , ['f' => $f, 'alumnos'=> $alumnos,'asistencias'=> $asistencias]);
    }


    public function vistaadmins(){
        $admins=Admin::All();
        return view('vistaadmins' , ['admins' => $admins]);
    }


    public function crearadmin(){
        
        return view('crearadmin');
    }


    public function storeadmin(Request $request){
            
        $validated = $request->validate([
            'nombre'=>'required|string|max:255',
            'apellido'=>'required|string|max:255',
            'email'=>'required|string|email|max:255|unique:users|regex:/^[a-z]{2,20}\.[a-z]{2,20}@itsmotul.edu.mx$/',
            'password' => 'required','confirmed', Rules\Password::defaults(),
            'rol'=> 'required',
        ]);
         
        $rol='admin';
        
        $user=new User;
        $user->name= $request->nombre;
        $user->last_name= $request->apellido;
        $user->email= $request->email;
        $user->password= Hash::make($request->password);
        $user->rol=$rol;
        $user->save();

        $hasrole = New Model_has_role;
        $hasrole->role_id= $request->rol;
        $hasrole->model_type='App\Models\User';
        $hasrole->model_id=$user->id;
        $hasrole->save();

        $admin= new Admin;
        $admin->user_id=$user->id;
        $admin->save();
            
       
        return redirect('/admin/administradores');              
    }


    public function editadmins($id){
        $admins=Admin::findOrFail($id);
        return view('editaradmin', ['admins' => $admins]);
    }

    public function updateadmins(Request $request, $id){
            
        $validated = $request->validate([
            'nombre'=>'required|min:2|max:50',
            'apellido'=>'required|min:2|max:50',
        ]);
        
        $admins = Admin::findOrFail($id);

        $user=User::findOrFail($admins->user->id);
        $user->name= $request->nombre;
        $user->last_name= $request->apellido;
        $user->save();

        return redirect('/admin/administradores');              
    }


    public function destroyeadmin($id, $id2)
    {

        $admin=Admin::findOrFail($id);
        $user=User::findOrFail($id2);
        
        
        if($user->id <> Auth()->user()->id){      
            $modelhasroles = Model_has_role::where("model_id","=",$user->id)->delete();
            $admin->delete();
            $user->delete();
            return redirect('/admin/administradores');
        }else{
            return redirect('/admin/administradores')->with('error', 'No se puede eliminar a si mismo');
        }
        //return($modelhasroles->model_id);
    
    }

    public function destroyetaller($id)
    {

        $taller = Taller::find($id);

        $alumnos = $taller->alumnos;
       
        if ($alumnos->count() == 0){
            $taller->delete();
            return redirect('/admin/talleres');
        }else{
            return redirect('/admin/talleres')->with('error', 'No se puede eliminar a este taller porque tiene alumnos registrados');
        }


        //return($modelhasroles->model_id);
    
    }

    public function destroyeperiodo($id)
    {

        $periodo = Periodo::find($id);
        $talleres = $periodo->tallers;
        
        if ($talleres->count() == 0){
            $periodo->delete();
            return redirect('/admin/periodos');
        }else{
            return redirect('/admin/periodos')->with('error', 'No se puede eliminar a este periodo porque tiene talleres registrados');
        }
        
    }





}
