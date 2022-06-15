<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;
use App\Models\Alumno;
use App\Models\Taller;
use App\Models\Municipio;
use App\Models\Model_has_role;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use Livewire\WithPagination;

class CreateAlumno extends Component
{
    use WithPagination;

    public $buscador = '';

    //variables de inicialización
    public $talleres;
    public $municipio;
    public $discapacidad;

    //variables de obtencion dedats
    public $taller;
    public $muni;
    public $cult;
    public $carrera;
    public $telefono;
    public $sexo;
    public $edad;
    public $password;
    public $email;
    public $last_name;
    public $name;

// ----------------------------------------------- Buscador -------------------------------------------------------------
    protected $queryString = [
        'buscador' => ['except' => '', 'as' => 'taller'],
        'page' => ['except' => 1, 'as' => 'página'],
    ];

    //debe tener el mismo nombre en mayusculas de la variable a buscar
    public function updatingBuscador(){
        $this->resetPage();
    }
    
//  ---------------------------------------------- validaciones maestro -------------------------------------------------
    protected $rules = [
        'name'=>'required|string|max:255',
        'last_name'=>'required|string|max:255',
        'email'=>'required|string|email|max:255|unique:users|regex:/^[a-z]{2,20}\.[0-9]{8}@itsmotul.edu.mx$/',
        'password' => 'required',
        'edad'=>'required|max:2',
        'sexo'=>'required|in:1,2',
        'telefono'=>'required|max:10|regex:/[0-9]/',
        'carrera'=>'required',
        'muni'=>'required',
        'cult'=>'required|in:1,2',
        'discapacidad'=>'required|in:1,2',
        'taller'=>'required',
        
    ];

// ------------------------------------------------ resetear input maestro -----------------------------------------------
    public function resetInput(){
        //resetea validaciones
        $this->resetValidation();
        //limpia caja de texto
        $this->name = '';
        $this->password = '';
        $this->last_name = '';
        $this->email = '';
        $this->sexo = '';
        $this->edad = '';
        $this->telefono = '';
        $this->carrera = '';
        $this->taller = '';
        $this->cultura = '';
        $this->muni = '';
        $this->discapacidad = '';
    }

// ------------------------------------------------ funciones para crear maestro ----------------------------------------
    public function submit(){
                    
        $this->validate();
        
        $role='alumno';

        $user=new User;
        $user->name= $this->name;
        $user->last_name= $this->last_name;
        $user->email= $this->email;
        $user->password= Hash::make($this->password);
        $user->rol=$role;
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
        $Alumno->edad = $this->edad;
        $Alumno->sexo = $this->sexo;
        $Alumno->telefono = $this->telefono;
        $Alumno->carrera = $this->carrera;
        $Alumno->matricula = $mat;
        $Alumno->municipio_id = $this->muni;
        $Alumno->culturaetnia = $this->cult;
        $Alumno->discapacidad = $this->discapacidad;
        $Alumno->user_id=$user->id;
        $Alumno->taller_id=$this->taller;
        $Alumno->save();

        $a = $this->taller;

        $this->mount();
        $this->cerrarmodal('#modal1');
        $this->resetInput();

        return redirect('/admin/taller/alumnos/'.$a)->with('success', 'Alumno creado correctamente');
    }

// --------------------------------------------------- funciones para cerrar modal ----------------------------------
    public function cerrarmodal($modal){
        $this->emit('SCreate', $modal);
    }

// -----------------------------------------------------  Monta las variables necesarias -----------------------------------------------
    public function mount(){
        $this->talleres = Taller::All();
        $this->municipio = Municipio::All();
    }
    
    public function render()
    {
        return view('livewire.create-alumno',[
            'tallers' => Taller::where('taller','LIKE','%'.$this->buscador.'%')->Paginate(10), 
        ]);
    }
}