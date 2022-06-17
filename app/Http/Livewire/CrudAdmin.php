<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;
use App\Models\Admin;

use App\Models\Model_has_role;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use Livewire\WithPagination;
class CrudAdmin extends Component
{
    use WithPagination;
    //buscador
    public $buscador = "";

    //variables de validacion
    public $name;
    public $last_name;
    public $email;
    public $password;
    public $rol = '';
    public $user_id;

    protected $listeners = ['destroye'];

// ----------------------------------------------- Buscador -------------------------------------------------------------
    protected $queryString = [
        'buscador' => ['except' => '', 'as' => 'admin'],
        'page' => ['except' => 1, 'as' => 'página'],
    ];

    //debe tener el mismo nombre en mayusculas de la variable a buscar
    public function updatingBuscador(){
        $this->resetPage();
    }

//  ---------------------------------------------- validaciones admin -------------------------------------------------
    protected $rules = [
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users|regex:/^[a-z]{2,30}@itsmotul.edu.mx$/',
        'password' => 'required',
        'rol' => 'required',
    ];

// ------------------------------------------------ resetear input admin -----------------------------------------------
    public function resetInput(){
        //resetea validaciones
        $this->resetValidation();
        //limpia caja de texto
        $this->name = '';
        $this->last_name = '';
        $this->email = '';
        $this->password = '';
        $this->rol = '';
    }

// ------------------------------------------------ funciones para crear admin ----------------------------------------
    public function submit(){
        
        $this->validate();

        $role='admin';
        $user=new User;
        $user->name= $this->name;
        $user->last_name= $this->last_name;
        $user->email= $this->email;
        $user->password= Hash::make($this->password);
        $user->rol=$role;
        $user->save();
        
        
        $hasrole = New Model_has_role;
        $hasrole->role_id= $this->rol;
        $hasrole->model_type='App\Models\User';
        $hasrole->model_id=$user->id;
        $hasrole->save();

        $admin= new Admin;
        $admin->user_id=$user->id;
        $admin->save();

        /*
        User::create([
            'name' => $this->name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'rol' => 'alumno'
        ]);*/

        $this->mount();
        $this->cerrarmodal('#modal1');
        $this->resetInput();
        $this->emit('mensaje', 'Usuario creado correctamente', 'success');
    }

// --------------------------------------------------- funciones para editar admin------------------------------------
    public function edit($id){
        $user = User::where('id','=',$id)->first();

        $this->user_id = $id;
        $this->name = $user->name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
    }

    public function update(){
        //valida solo los campos de nombre y apellido sin interferir en el email
        $this->validate([  
            'name' => 'required|string|max:255' , 
            'last_name' => 'required|string|max:255',
        ]); 
        
        if ($this->user_id){
            $user = User::find($this->user_id);
            $user->update([
                'name' => $this->name,
                'last_name' => $this->last_name,
            ]);

            $this->mount();
            $this->resetInput();
            $this->cerrarmodal('#modal2');
            $this->emit('mensaje', 'Usuario actualizado', 'success');
        } 
    }
 
// --------------------------------------------------- funciones para cerrar modal ----------------------------------
    public function cerrarmodal($modal){
        $this->emit('SCreate', $modal);
    }

// --------------------------------------------------- funciones para eliminar admin----------------------------------
    public function destroye(User $userId, Admin $adminId){
        
        if($userId->id <> Auth()->user()->id){  
            $modelhasroles = Model_has_role::where("model_id","=",$userId->id)->delete();
            $adminId->delete();
            $userId->delete();
            $this->emit('mensaje', 'Usuario eliminado', 'success');
        }else{
            $this->emit('mensaje', 'No se puede eliminar a si mismo', 'error');
        }

        $this->mount();
        
        //with('eliminar', 'user id = '.$userId->id.' admin id = '.$adminId->id);
    }


//  -----------------------------------------------------  rederiza lapagina -----------------------------------------    
    public function render()
    {
        return view('livewire.crud-admin',[
            'admins' => User::where('rol','=','admin')
                              ->where('name','LIKE','%'.$this->buscador.'%')
                              ->Paginate(2), 
        ]);
    }
}