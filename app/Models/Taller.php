<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Taller extends Model
{
    use HasFactory;

    public function alumnos(){
        return $this->hasMany(Alumno::class);
    }

    public function maestro(){
        return $this->belongsTo(Maestro::class);
    }

    public function periodo(){
        return $this->belongsTo(Periodo::class);
    }

    public function asistencias(){
        return $this->hasMany(Asistencia::class);
    }

   
}
