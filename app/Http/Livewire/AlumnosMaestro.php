<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User; 

use Livewire\WithPagination;

class AlumnosMaestro extends Component
{
    use WithPagination;

    public $idtaller = 'idtaller';

    //buscador
    public $buscador = "";

// ----------------------------------------------- Buscador -------------------------------------------------------------
    protected $queryString = [
        'buscador' => ['except' => '', 'as' => 'admin'],
        'page' => ['except' => 1, 'as' => 'página'],
    ];

    //debe tener el mismo nombre en mayusculas de la variable a buscar
    public function updatingBuscador(){
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.alumnos-maestro',[
            'alumnos' => User::whereRelation('Alumno','taller_id','=',$this->idtaller)
                              ->where('name','LIKE','%'.$this->buscador.'%')
                              ->Paginate(10), 
        ]);
    }
}
