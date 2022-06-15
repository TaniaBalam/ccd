<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Casts\Attribute;

class Alumno extends Model
{
    use HasFactory;

    
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function municipio(){
        return $this->belongsTo(Municipio::class);
    }

    public function taller(){
        return $this->belongsTo(Taller::class);
    }

    public function asistencias(){
        return $this->hasMany(Asistencia::class);
    }

    
    protected function sexo():Attribute{ 
        return Attribute::make(
            //Accesor
            get: function($value){
                if ($value == 1){
                    return "Masculino";
                }
                if ($value == 2){
                    return "Femenino";
                }
               
            }

        );
    }

    protected function carrera():Attribute{ 
        return Attribute::make(
            //Accesor
            get: function($value){
                if ($value == 1){
                    return "Ingeniería en Sistemas Computacionales";
                }
                if ($value == 2){
                    return "Ingeniería Industrial";
                }
                if ($value == 3){
                    return "Ingeniería Electrónica";
                }
                if ($value == 4){
                    return "Ingeniería en Energías Renovables";
                }
                if ($value == 5){
                    return "Ingeniería Electromécanica";
                }
               
            }

        );
    }

    protected function culturaetnia():Attribute{ 
        return Attribute::make(
            //Accesor
            get: function($value){
                if ($value == 1){
                    return "Si";
                }
                if ($value == 2){
                    return "No";
                }
               
            }

        );
    }

    protected function discapacidad():Attribute{ 
        return Attribute::make(
            //Accesor
            get: function($value){
                if ($value == 1){
                    return "Si";
                }
                if ($value == 2){
                    return "No";
                }
               
            }

        );
    }

  
}
