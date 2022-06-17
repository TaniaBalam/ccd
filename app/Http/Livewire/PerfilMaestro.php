<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Maestro;
use App\Models\User;
use Livewire\WithFileUploads;

class PerfilMaestro extends Component
{

    use WithFileUploads;
    public $imagen, $urlimagen;
    
    public $maestro;

    public $name;
    public $last_name;
    public $idmaestro;
    public $numero;

    protected $listeners = ['cargar'];

    //funcion para guardar la imagen
    public function imgperfil(){
        $this->validate([  
            'imagen' => 'required|image|mimes:jpeg,png,jpg|max:1024',
        ]); 

        $img = $this->imagen->storeAs('perfil', 'avatar'.Auth()->user()->id.'.'.$this->imagen->getClientOriginalExtension());
        
        $user = User::find(Auth()->user()->id);
        $user->url_image = $img;
        $user->save();
        
        $this->emit('SCreate', '#perfil'); //cierra el modal
        $this->reset('imagen'); //resetea el campo del temporar cargada
        $this->emit('mensaje', 'Imagen de perfil actualizada correctamente', 'success'); //alertas que yo utilizo para sweetaler2

    }

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

        //coloca la url de la imagen si es vacio carga una imagen predeterminada si no carga la imagen del usuario
        if(Auth()->user()->url_image != NULL){
            $this->urlimagen = asset('storage/'.Auth()->user()->url_image);
        }else{
            $this->urlimagen=asset('storage/perfil/fotoPerfil.png');
        }

        return view('livewire.perfil-maestro');
    }
}
