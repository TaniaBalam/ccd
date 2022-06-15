<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\Alumno;
use App\Models\Taller;
use App\Models\User;
use App\Models\Maestro;
use App\Models\Asistencia;
use App\Models\Periodo;

use Codedge\Fpdf\Fpdf\Fpdf;
use Carbon\Carbon;


class AlumnoController extends Controller
{
    //------------------------------------------------- utilizados ----------------------------------------------------------------
    public function crear(){
        $municipio=Municipio::All();
        return view('crearalumno' , ['municipio' => $municipio]);
    }


    public function store(Request $request){
            
        $validated = $request->validate([
            'edad'=>'required|max:2',
            'sexo'=>'required|in:1,2',
            'telefono'=>'required|max:10|regex:/[0-9]/',
            'carrera'=>'required',
            'municipio'=>'required',
            'culturaetnia'=>'required|in:1,2',
            'discapacidad'=>'required|in:1,2',
        ]);
         

        $cadena = Auth()->user()->email;

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
        $Alumno->user_id=Auth()->user()->id;


        $alumnos = Alumno::where("user_id","=",Auth()->user()->id)->get();

    
        if($alumnos->count() == 0){
            
            $Alumno->save();
            return redirect('/alumno/talleres');  
            
        }else{
            return redirect('/alumno/crear')->with('error', 'Ya ha registrado sus datos');
        }
        
                    
    }

    //inicio
    public function vistataller(){
        $Alumno = Auth()->user()->alumno;
        return view('talleresalumno' , ['Alumno' => $Alumno]);
    }


    //asistencias
    public function vistaasistencia(){
        $alumno=Auth()->user()->alumno;
        $f=0;
        $asistencias = Asistencia::distinct('fecha')->where('taller_id','=',$alumno->taller_id)->count();

        if ($asistencias>=1){
            $f=round($asistencias*.7);
        }else{
            $f=0; 
        }

        $asistencias2=Asistencia::where('alumno_id','=', $alumno->id)
                                  ->where('af','=',1)->count();

        $asistencias3=Asistencia::where('alumno_id','=', $alumno->id)
                                  ->where('af','=',2)->count();

        $asistenciasalum=Asistencia::where('alumno_id','=', $alumno->id)->get();

        if ($asistenciasalum->count()>=1){
            $porcasis=($asistencias2*100)/$asistencias;
        }else{
            $porcasis=0;
        }
        
        return view('asistenciasalumno' , ['alumno' =>$alumno, 'f' => $f,'asistencias2'=> $asistencias2, 'asistencias3'=> $asistencias3, 'asistenciasalum'=> $asistenciasalum, 'porcasis' => round($porcasis)]);
    }

    

    public function edit2(){
        return view('actualizaralumno');
    }

    
    protected $fpdf;
 
    public function __construct()
    {
        $this->fpdf = new Fpdf('P','mm','letter');
    }


    public function pdf(){
        $Alumno = Auth()->user()->alumno;
        $date = Carbon::now()->format('d-m-Y');
        $this->fpdf->SetFont('Arial','B',18);
        $this->fpdf->AddPage();
        $this->fpdf->Cell(5);
        $this->fpdf->Cell(95,25,'Constancia de cumplimiento de actividad complementaria');
        $this->fpdf->Ln();
        $this->fpdf->SetFont('Arial','B',12);
        $texto="El que suscribe el/la maestro(a)"." ".$Alumno->taller->maestro->user->name." ".$Alumno->taller->maestro->user->last_name 
        ." "."por este medio se permite hacer de su conocimiento que el/la estudiante"." ".$Alumno->user->name." ".$Alumno->user->last_name." "."con número de control"." ".$Alumno->matricula
        ." "."de la carrera de"." ".$Alumno->carrera." "."ha cumplido su actividad complementaria en el taller de"." ".$Alumno->taller->taller." "."durante el periodo escolar"." ".$Alumno->taller->periodo->periodo
        ." "."con un valor curricular de 1 crédito. Se extiende la presente en la ciudad de Motul, Yucatán el"." ".$date.".";
        $this->fpdf->Cell(5);
        $this->fpdf->MultiCell(180, 5, utf8_decode($texto));  
        $this->fpdf->Image('https://cbtis164.com.mx/web/img/ui/logo-sep-cbtis53.png',60,120,90,0,'PNG');
       
        $this->fpdf->Output();

        exit;
    }



}
