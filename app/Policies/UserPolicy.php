<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Taller;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    public function vistaveralumnos2(User $user, Taller $taller)
    {
        return $user->maestro->id == $taller->maestro_id;
    }

    public function asistencias(User $user, Taller $taller)
    {
        return $user->maestro->id == $taller->maestro_id;
    }

    public function reporteasistencia(User $user, Taller $taller)
    {
        return $user->maestro->id == $taller->maestro_id;
    }

    public function editarasistencias(User $user, Taller $taller)
    {
        return $user->maestro->id == $taller->maestro_id;
    }

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
}
