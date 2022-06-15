<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Periodo;

use Livewire\WithPagination;

class CrudPeriodo extends Component
{
    use WithPagination;
    //buscador
    public $buscador = "";

    public $periodo;
    public $fechaemision;
    public $fechaexpiracion;
    public $user_id;

    //oyente
    protected $listeners = ['destroye'];
    
// ----------------------------------------------- Buscador -------------------------------------------------------------
    protected $queryString = [
        'buscador' => ['except' => '', 'as' => 'periodo'],
        'page' => ['except' => 1, 'as' => 'página'],
    ];

    //debe tener el mismo nombre en mayusculas de la variable a buscar
    public function updatingBuscador(){
        $this->resetPage();
    }

//  ---------------------------------------------- validaciones maestro -------------------------------------------------
    protected $rules = [
        'periodo' => ['required', 'regex:/^20[0-9]{2}A|B$/'],
        'fechaemision'=>'required',
        'fechaexpiracion'=>'required|after_or_equal:fechaemision',
    ];

// ------------------------------------------------ resetear input periodo -----------------------------------------------
    public function resetInput(){
        //resetea validaciones
        $this->resetValidation();
        //limpia caja de texto
        $this->periodo = '';
        $this->fechaemision = '';
        $this->fechaexpiracion = '';
    }

// ------------------------------------------------ funciones para crear maestro ----------------------------------------
    public function submit(){
                
        $this->validate();
        $periodo = new Periodo;
        $periodo->periodo = $this->periodo;
        $periodo->fecha_emision = $this->fechaemision;
        $periodo->fecha_expiracion = $this->fechaexpiracion;
        $periodo->save();

        $this->mount();
        $this->cerrarmodal('#modal1');
        $this->resetInput();
        $this->emit('mensaje', 'Periodo creado correctamente', 'success');
    }

// --------------------------------------------------- funciones para editar maestro------------------------------------
    public function edit($id){
        $periodo = Periodo::where('id','=',$id)->first();
        
        $this->periodo_id = $id;
        $this->periodo = $periodo->periodo;
        $this->fechaemision = $periodo->fecha_emision;
        $this->fechaexpiracion = $periodo->fecha_expiracion;
    }

    public function update(){


        //valida solo los campos de nombre y apellido sin interferir en el email
        $this->validate([
            'periodo'=>  ['required', 'regex:/^20[0-9]{2}A|B$/'],
            'fechaemision'=>'required',
            'fechaexpiracion'=>'required|after_or_equal:fechaemision',
        ]); 

        $periodo=Periodo::findOrFail($this->periodo_id);
        
        $periodo->periodo = $this->periodo;
        $periodo->fecha_emision = $this->fechaemision;
        $periodo->fecha_expiracion = $this->fechaexpiracion;
        $periodo->save();

        $this->mount();
        $this->resetInput();
        $this->cerrarmodal('#modal2');
        $this->emit('mensaje', 'Periodo actualizado correctamente', 'success');        
    }

// --------------------------------------------------- funciones para eliminar admin----------------------------------
    public function destroye(Periodo $periodoId){
        $talleres = $periodoId->tallers;

        if ($talleres->count() == 0){
            $periodoId->delete();
            $this->emit('mensaje', 'Periodo eliminado correctamente', 'success');
        }else{
            $this->emit('mensaje', 'No se puede eliminar a este periodo por que hay algún taller registrado', 'error');
        }

        $this->mount();
    }

// --------------------------------------------------- funciones para cerrar modal ----------------------------------
    public function cerrarmodal($modal){
        $this->emit('SCreate', $modal);
    }

// ------------------------------------------------ monta los datos necesarios -----------------------------------------------

    public function render()
    {
        return view('livewire.crud-periodo',[
            'periodos' => Periodo::where('periodo','LIKE','%'.$this->buscador.'%')->Paginate(10),
        ]);
    }
}
