<?php

namespace App\Http\Livewire;

use App\Models\Taller;
use App\Models\User;
use App\Models\Periodo;

use Livewire\Component;
use Livewire\WithPagination;

class CrudTaller extends Component
{

    use WithPagination;

    public $buscador = '';

    //variables de validacion
    public $taller;
    public $descripcion;
    public $maestro;
    public $horario;
    public $periodo;
    public $imagen;
    public $taller_id;

    public $p;
    
    public $usuarios;
    public $periodos;

    //oyente
    protected $listeners = ['destroye'];

    protected $queryString = [
        'buscador' => ['except' => '', 'as' => 'taller'],
        'page' => ['except' => 1, 'as' => 'página'],
    ];

//  ---------------------------------------------- validaciones maestro -------------------------------------------------
    protected $rules = [
        'taller' => 'required|min:2|max:45',
        'descripcion'=>'required|min:5|max:500',
        'maestro'=>'required',
        'horario'=>'required|min:5|max:250',
        'periodo'=>'required',
        'imagen'=>'required|url',
    ];

// ------------------------------------------------ resetear input maestro -----------------------------------------------
    public function resetInput(){
        //resetea validaciones
        $this->resetValidation();
        //limpia caja de texto
        $this->taller = '';
        $this->descripcion = '';
        $this->maestro = '';
        $this->horario = '';
        $this->periodo = '';
        $this->imagen = '';
    }

// ------------------------------------------------ funciones para crear maestro ----------------------------------------
    public function submit(){
                
        $this->validate();
        
        $taller= new Taller;
        $taller->taller = $this->taller;
        $taller->descripcion = $this->descripcion;
        $taller->maestro_id = $this->maestro;
        $taller->horario = $this->horario;
        $taller->periodo_id = $this->periodo;
        $taller->imagen = $this->imagen;
        $taller->save();

        $this->cerrarmodal('#modal1');
        $this->resetInput();
        $this->mount();

    }

// --------------------------------------------------- funciones para editar maestro------------------------------------
    public function edit($id){
        
        $tall = Taller::where('id','=',$id)->first();

        $this->taller_id = $id;
        $this->taller =  $tall->taller;
        $this->descripcion =  $tall->descripcion;
        
        
        if(empty($tall->maestro->user)){
            $this->maestro =  "Sin maestro";
            
        }else{
            $this->maestro =  $tall->maestro->user->name;
        }

        $this->horario =  $tall->horario;
        $this->periodo =  $tall->periodo->periodo;
        $this->imagen =  $tall->imagen;

    }

    public function update(){
        //valida solo los campos de nombre y apellido sin interferir en el email
        $this->validate([
            'taller' => 'required|min:2|max:45',
            'descripcion'=>'required|min:5|max:500',
            'maestro'=>'required',
            'horario'=>'required|min:5|max:250',
            'imagen'=>'required|url',
        ]); 

        
        if(!is_numeric($this->periodo)){
            $pe = Periodo::where('periodo','=',$this->periodo)->get()->all();
            foreach($pe as $periodo){
                $this->periodo = $periodo->id;
            }
            
        }

        if(!is_numeric($this->maestro)){
            $pe = User::where('name','=',$this->maestro)->get()->all();
            foreach($pe as $maestro){
                $this->maestro = $maestro->maestro->id;
            }
        }
        
        if ($this->taller_id){
            $taller = Taller::find($this->taller_id);
            
            $taller->taller = $this->taller;
            $taller->descripcion = $this->descripcion;
            $taller->maestro_id = $this->maestro;
            $taller->horario = $this->horario;
            $taller->periodo_id = $this->periodo;
            $taller->imagen = $this->imagen;
            $taller->save();

            $this->resetInput();
            $this->cerrarmodal('#modal2');
            $this->mount();
        } 
    }

// --------------------------------------------------- funciones para eliminar admin----------------------------------
    public function destroye(Taller $tallerId){
        
        $alumnos = $tallerId->alumnos;
        
        if ($alumnos->count() == 0){
            $tallerId->delete();
            return redirect('/admin/talleres')->with('eliminar', 'Taller eliminado correctamente');
        }else{
            return redirect('/admin/talleres')->with('error', 'No se puede eliminar a este taller porque tiene alumnos registrados');
        }

    }

// --------------------------------------------------- funciones para cerrar modal ----------------------------------
    public function cerrarmodal($modal){
        $this->emit('SCreate', $modal);
    }

    public function mount(){
        $this->usuarios= User::All();
        $this->periodos = Periodo::All();
    }

    //debe tener el mismo nombre en mayusculas de la variable a buscar
    public function updatingBuscador(){
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.crud-taller',[
            'tallers' => Taller::where('taller','LIKE','%'.$this->buscador.'%')->Paginate(10), 
        ]);
    }
}