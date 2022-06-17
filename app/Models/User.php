<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Casts\Attribute;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'rol',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function alumno() {
        return $this->hasOne(Alumno::class);
    }


    public function maestro() {
        return $this->hasOne(Maestro::class);
    }

     //Model User
    Protected function name(): Attribute
    {
        return Attribute::make(
            //Accesor	
            get:fn($value)=>ucwords(mb_strtolower($value)),
            
            //Mutator
            set:fn($value)=>ucwords(mb_strtolower($value))
        );
    }

    Protected function lastname(): Attribute
    {
        return Attribute::make(
            //Accesor	
            get:fn($value)=>ucwords(mb_strtolower($value)),
            
            //Mutator
            set:fn($value)=>ucwords(mb_strtolower($value))
        );
    }


    public function rol() {
        return $this->hasOne(Model_has_role::class);
    }

    public function admin() {
        return $this->hasOne(Admin::class);
    }

    
}
