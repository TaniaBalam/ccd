<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

class PerfilAdmin extends Component

{

    public $admin;

    public $name;
    public $last_name;
    public $idadmin;

    protected $listeners = ['cargar'];

    public function cargar(){
        $this->mount();
    }

    public function mount(){
        $this->admin = Auth()->user();
        $this->idadmin = $this->admin->id;
        $this->name = $this->admin->name;
        $this->last_name = $this->admin->last_name;
    }


    public function update(){
        //valida solo los campos de nombre y apellido sin interferir en el email
        $this->validate([  
            'name' => 'required|string|max:255' , 
            'last_name' => 'required|string|max:255',
        ]); 
        

        if ($this->idadmin){
            $user = User::find($this->idadmin);
            $user->update([
                'name' => $this->name,
                'last_name' => $this->last_name,
            ]);

            $this->emit('mensaje', 'Admin actualizado correctamente', 'success');
        } 
    }

    public function render()
    {
        return view('livewire.perfil-admin');
    }
}
