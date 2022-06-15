<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Maestro;
use App\Models\User;

class PerfilMaestro extends Component
{

    public $maestro;

    public $name;
    public $last_name;
    public $idmaestro;
    public $numero;

    protected $listeners = ['cargar'];

    public function cargar(){
        $this->mount();
    }

    public function update(){
        //valida solo los campos de nombre y apellido sin interferir en el email
        $this->validate([  
            'name' => 'required|string|max:255' , 
            'last_name' => 'required|string|max:255',
        ]); 
        

        if ($this->idmaestro){
            $maestro = Maestro::find($this->idmaestro);
            $user = User::find($this->maestro->user->id);
            $user->update([
                'name' => $this->name,
                'last_name' => $this->last_name,
            ]);

            $this->emit('mensaje', 'Maestro actualizado correctamente', 'success');
        } 
    }
    
    public function mount(){
        $this->maestro = Auth()->user()->maestro;

        $this->idmaestro = $this->maestro->id;
        $this->name = $this->maestro->user->name;
        $this->last_name = $this->maestro->user->last_name;

    }



        
    public function render()
    {
        return view('livewire.perfil-maestro');
    }
}
