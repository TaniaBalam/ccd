<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithFileUploads;

class PerfilAdmin extends Component

{
    use WithFileUploads;

    public $admin;

    public $name;
    public $last_name;
    public $idadmin;
    public $imagen, $urlimagen;
    public $imagen1;

    protected $listeners = ['cargar'];

    public function imgperfil(){
        $this->validate([  
            'imagen' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]); 

        $img = $this->imagen->storeAs('perfil', 'avatar'.$this->idadmin.'.'.$this->imagen->getClientOriginalExtension());
        
        $user = User::find($this->idadmin);
        $user->url_image = $img;
        $user->save();

        $this->emit('mensaje', 'Imagen de perfil actualizada correctamente', 'success');
        
    }

    
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
        if(Auth()->user()->url_image != NULL){
            $this->urlimagen = asset('storage/'.Auth()->user()->url_image);
        }else{
            $this->urlimagen=asset('storage/perfil/fotoPerfil.png');
        }

        return view('livewire.perfil-admin');
    }
}
