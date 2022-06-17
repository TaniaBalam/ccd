<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Periodo;
use App\Models\Alumno;
use App\Models\Taller;
use App\Models\User;

use Carbon\Carbon;

class TalleresAlumno extends Component
{
    public $Alumno;
    public $periodo;
    public $periodo2;
    public $tallers;
    public $diasDiferencia;

    protected $listeners = ['inscribirse'];

    public function inscribirse(Taller $taller){
        $Alumno = Auth()->user()->alumno;
        $Alumno->taller_id = $taller->id;
        $Alumno->save();
        $this->mount();
        $this->emit('mensaje', 'Inscripción hecha', 'success');
    }

    public function mount(){
        $this->Alumno = Auth()->user()->alumno;
        $this->periodo = Periodo::All()->last()->periodo;
        $this->periodo2 = Periodo::All()->last()->id;
        $this->tallers=Taller::where("periodo_id","=",$this->periodo2)->get();

        if(!empty($this->Alumno->taller_id)){
            $Hoy = now()->toDateString();
            $fechaExpiracion = Carbon::parse($this->Alumno->taller->periodo->fecha_expiracion);
            $this->diasDiferencia = $fechaExpiracion->diffInDays($Hoy);
        }

    }

    public function render()
    {
        return view('livewire.talleres-alumno');
    }
}
