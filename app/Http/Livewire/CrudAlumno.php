<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;
use App\Models\Asistencia;
use App\Models\Alumno;
use App\Models\Taller;
use App\Models\Municipio;
use App\Models\Model_has_role;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use Livewire\WithPagination;

class CrudAlumno extends Component
{
    use WithPagination;
    //buscador
    public $buscador = '';

    //carga lavariable id del taller
    public $idtaller = 'idtaller';

    //variables de validacion
    public $name;
    public $last_name;
    public $email;
    public $password;
    public $sexo;
    public $edad;
    public $telefono;
    public $carrera;
    public $tallers;
    public $cultura;
    public $muni;
    public $municipio;
    public $discapacidad;
    public $user_id;

    //oyente
    protected $listeners = ['destroye'];

// ----------------------------------------------- Buscador -------------------------------------------------------------
    protected $queryString = [
        'buscador' => ['except' => '', 'as' => 'alumno'],
        'page' => ['except' => 1, 'as' => 'página'],
    ];

    //debe tener el mismo nombre en mayusculas de la variable a buscar
    public function updatingBuscador(){
        $this->resetPage();
    }

//  ---------------------------------------------- validaciones alumno -------------------------------------------------
    protected $rules = [
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users|regex:/^[a-z]{2,20}\.[a-z]{2,20}@itsmotul.edu.mx$/',
        'password' => 'required',
        'edad'=>'required|max:2',
        'sexo'=>'required|in:1,2',
        'telefono'=>'required|max:10|regex:/[0-9]/',
        'carrera'=>'required',
        'muni'=>'required',
        'cultura'=>'required|in:1,2',
        'discapacidad'=>'required|in:1,2',
        'tallers'=>'required',
    ];

// ------------------------------------------------ resetear input alumno -----------------------------------------------
    public function resetInput(){
        //resetea validaciones
        $this->resetValidation();
        //limpia caja de texto
        $this->name = '';
        $this->last_name = '';
        $this->email = '';
        $this->sexo = '';
        $this->edad = '';
        $this->telefono = '';
        $this->carrera = '';
        $this->tallers = '';
        $this->cultura = '';
        $this->muni = '';
        $this->discapacidad = '';
    }

// --------------------------------------------------- funciones para editar alumno------------------------------------
    public function opcion($dato){
        $this->sexo = $dato;
    }

    public function opcion2($dato){
        $this->car = $dato;
    }

    public function opcion3($dato){
        $this->cultura = $dato;
    }

    public function opcion4($dato){
        $this->discapacidad = $dato;
    }

    public function edit($id){
        $user = User::where('id','=',$id)->first();
        $this->tallers = $user->alumno->taller->taller;
        $this->user_id = $id;
        $this->name = $user->name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->matricula = $user->alumno->matricula;
        $this->edad = $user->alumno->edad;
        $this->sexo = $user->alumno->sexo;
        $this->telefono = $user->alumno->telefono;
        $this->carrera = $user->alumno->carrera;
        $this->cultura = $user->alumno->culturaetnia;
        $this->muni = $user->alumno->municipio->municipio;
        $this->discapacidad = $user->alumno->discapacidad;
    }

    public function update(){
        //valida solo los campos de nombre y apellido sin interferir en el email
        $this->validate([  
            'name'=>'required|min:2|max:50',
            'last_name'=>'required|min:2|max:50',
            'edad'=>'required|max:2',
            'telefono'=>'required|max:10|regex:/[0-9]/',
        ]); 

        if ($this->user_id){
            $user = User::find($this->user_id);
            $alumno = Alumno::find($user->alumno->id);

            //selecciona sexo
            if($this->sexo == 'Masculino'){
                $this->sexo = 1;
            }
            if($this->sexo == 'Femenino'){
                $this->sexo = 2;
            }

            //selecciona carrera
            if($this->carrera == 'Ingeniería en Sistemas Computacionales' or $this->carrera == 1){
                $this->carrera = 1;
            }
            if($this->carrera == 'Ingeniería Industrial' or $this->carrera == 2){
                $this->carrera = 2;
            }
            if($this->carrera == 'Ingeniería Electrónica' or $this->carrera == 3){
                $this->carrera = 3;
            }
            if($this->carrera == 'Ingeniería en Energías Renovables' or $this->carrera == 4){
                $this->carrera = 4;
            }
            if($this->carrera == 'Ingeniería Electromécanica' or $this->carrera == 5){
                $this->carrera = 5;
            }

            //selecciona cultura
            if($this->cultura == 'Si'){
                $this->cultura = 1;
            }
            if($this->cultura == 'No'){
                $this->cultura = 2;
            }    

            //selecciona municipio
            if(!is_numeric($this->muni)){
                $municipio = Municipio::where('municipio','=',$this->muni)->get()->all();
                foreach($municipio as $id){
                    $this->muni = $id->id;
                }
            }

            //selecciona discapacidad
            if($this->discapacidad == 'Si'){
                $this->discapacidad = 1;
            }
            if($this->discapacidad == 'No'){
                $this->discapacidad = 2;
            }

            //selecciona taller
            if(!is_numeric($this->tallers)){
                $talleres = Taller::where('taller','=',$this->tallers)->get()->all();
                foreach($talleres as $id){
                    
                    $this->tallers = $id->id;
                }
            }
            $a = $this->tallers;
            
            $alumno->update([
                'edad' => $this->edad,
                'sexo' => $this->sexo,
                'telefono' => $this->telefono,
                'carrera' => $this->carrera,
                'municipio_id' => $this->muni,
                'culturaetnia' => $this->cultura,
                'discapacidad' => $this->discapacidad,
                'taller_id' => $this->tallers,
            ]);

            $user->name= $this->name;
            $user->last_name= $this->last_name;
            $user->save();

            $this->mount();
            $this->resetInput();
            $this->cerrarmodal('#modal2');
            if($this->idtaller<>$a){
                return redirect('/admin/taller/alumnos/'.$a)->with('success', 'Alumno actualizo correctamente al alumno');
            }else{
                $this->emit('mensaje', 'Alumno actualizado correctamente', 'success');
            }
        } 
    }


// --------------------------------------------------- funciones para eliminar alumno----------------------------------
    public function destroye(User $userId, Alumno $alumnoId){
        $asistencias = Asistencia::where("alumno_id","=",$alumnoId->id)->get();
        $modelhasroles = Model_has_role::where("model_id","=",$userId->id)->delete();

        if($asistencias->count() <> 0){
            $asistencias->each->delete();
        }

        $alumnoId->delete();
        $userId->delete();

        $this->emit('mensaje', 'Alumno eliminado correcto', 'success');
        $this->mount();
    }

// --------------------------------------------------- funciones para cerrar modal ----------------------------------
    public function cerrarmodal($modal){
        $this->emit('SCreate', $modal);
    }


//-------------------------------------------------------  monta la variables alumno -----------------------------------
    public function mount(){

        $this->taller=Taller::All();
        $this->municipio=Municipio::All();
        
    }
    
    public function render()
    {
        return view('livewire.crud-alumno',[
            'admins' => User::whereRelation('Alumno','taller_id','=',$this->idtaller)
                              ->where('name','LIKE','%'.$this->buscador.'%')
                              ->Paginate(10), 
        ]);
    }
}
