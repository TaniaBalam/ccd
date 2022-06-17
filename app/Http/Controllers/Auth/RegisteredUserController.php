<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Model_has_role;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users','regex:/^[a-z]{2,20}\.([0-9]{8}|[a-z]{2,20})@itsmotul.edu.mx$/'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $cadena = $request->email;

        $separador = '@';
        $separada = explode($separador, $cadena);

        $cadena2 = $separada[0];

        $separador2 = '.';
        $separada2 = explode($separador2, $cadena2);

    
        if (preg_match("/^[0-9]{8}$/", $separada2[1])){
            $rol='alumno';
            $role=2;
        } else{
            $rol='maestro';
            $role=3;
        }

        $user = User::create([
            'name' => $request->name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'rol' => $rol,
        ]);

        $hasrole = Model_has_role::create([
            'role_id' => $role,
            'model_type' => 'App\Models\User',
            'model_id' => $user->id,
        ]);




     

        event(new Registered($user));
        event(new Registered($hasrole));

        Auth::login($user);

       
        if (Auth()->user()->hasRole('alumno')){

            return redirect(RouteServiceProvider::HOME2);

        } elseif (Auth()->user()->hasRole('maestro')){

            return redirect(RouteServiceProvider::HOME3);

        }
    }
}
