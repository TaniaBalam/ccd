<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Municipio;
use App\Models\Alumno;
use App\Models\User;

class PerfilAlumno extends Component
{

    public $municipio;
    public $Alumno;

    //datos
    public $idalumno;
    public $name;
    public $last_name;
    public $edad;
    public $sexo;
    public $telefono;
    public $car; //carrera
    public $cultura;
    public $muni; //municipio
    public $muniid; //municipio
    public $discapacidad;
    
    public function opcion($dato,$variable){
        $this->$variable = $dato;
    }

    public function opcion2($dato){
        $this->car = $dato;

    }

    public function mount(){
        $this->Alumno = Auth()->user()->alumno;
        $this->municipio=Municipio::All();

        $this->idalumno = $this->Alumno->id;

        $this->name = Auth()->user()->name;
        $this->last_name = Auth()->user()->last_name;
        $this->edad = $this->Alumno->edad;
        $this->sexo = $this->Alumno->sexo;
        $this->telefono = $this->Alumno->telefono;

        $this->car = $this->Alumno->carrera;

        $this->cultura = $this->Alumno->culturaetnia;

        //municipio 
        $this->muni = $this->Alumno->municipio->municipio;
        $this->muniid = $this->Alumno->municipio->id;

        $this->discapacidad = $this->Alumno->discapacidad;
    }

    public function update(){
        if(!is_numeric($this->sexo)){
            if($this->sexo == 'Masculino'){
                $this->sexo = 1;
            }else{
                $this->sexo = 2;
            }
        }
        if(!is_numeric($this->car)){
            //selecciona carrera
            if($this->car == 'Ingeniería en Sistemas Computacionales'){
                $this->car = 1;
            }
            if($this->car == 'Ingeniería Industrial'){
                $this->car = 2;
            }
            if($this->car == 'Ingeniería Electrónica'){
                $this->car = 3;
            }
            if($this->car == 'Ingeniería en Energías Renovables'){
                $this->car = 4;
            }
            if($this->car == 'Ingeniería Electromécanica'){
                $this->car = 5;
            }
        }

        if(!is_numeric($this->cultura)){
            if($this->cultura == 'No'){
                $this->cultura = 2;
            }else{
                $this->cultura = 1;
            }
        }
        
        if(!is_numeric($this->muni)){
            $this->muni = $this->muniid;
        }

        if(!is_numeric($this->discapacidad)){
            if($this->discapacidad == 'No'){
                $this->discapacidad = 2;
            }else{
                $this->discapacidad = 1;
            }
        }

        $this->validate([  
            'name'=>'required|min:2|max:50',
            'last_name'=>'required|min:2|max:50',
            'edad'=>'required|max:2',
            'sexo'=>'required|in:1,2',
            'telefono'=>'required|max:10|regex:/[0-9]/',
            'car'=>'required',
            'municipio'=>'required',
            'cultura'=>'required|in:1,2',
            'discapacidad'=>'required|in:1,2',
        ]); 

        $userid = Auth()->user()->alumno;
        //dd($userid->user_id.' '.Auth()->user()->id);
        if($userid->user_id == Auth()->user()->id){
            $Alumno=Alumno::findOrFail($this->idalumno);
            $Alumno->edad = $this->edad;
            $Alumno->sexo = $this->sexo;
            $Alumno->telefono = $this->telefono;
            $Alumno->carrera = $this->car;
            $Alumno->municipio_id = $this->muni;
            $Alumno->culturaetnia = $this->cultura;
            $Alumno->discapacidad = $this->discapacidad;
            $Alumno->save();
    
            $user=User::findOrFail(Auth()->user()->id);
            $user->name= $this->name;
            $user->last_name= $this->last_name;
            $user->save();
            $this->emit('mensaje', 'Perfil actualizado correctamente', 'success');
        }else{
            $this->emit('mensaje', 'No juegues con la pagína', 'error');
        }
    }


    public function render()
    {
        return view('livewire.perfil-alumno');
    }
}
