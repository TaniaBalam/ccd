<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\User;
use App\Models\Maestro;
use App\Models\Taller;
use App\Models\Model_has_role;

use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

use Livewire\WithPagination;

class CrudMaestro extends Component
{
    use WithPagination;

    //buscador
    public $buscador = "";

    //variables de validacion
    public $name;
    public $last_name;
    public $email;
    public $password;
    public $numero;
    public $user_id;

    public $maestros;
    public $tallers;

    //oyente
    protected $listeners = ['destroye'];

// ----------------------------------------------- Buscador -------------------------------------------------------------
    protected $queryString = [
        'buscador' => ['except' => '', 'as' => 'maestro'],
        'page' => ['except' => 1, 'as' => 'página'],
    ];

    //debe tener el mismo nombre en mayusculas de la variable a buscar
    public function updatingBuscador(){
        $this->resetPage();
    }

//  ---------------------------------------------- validaciones maestro -------------------------------------------------
    protected $rules = [
        'name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users|regex:/^[a-z]{2,20}\.[a-z]{2,20}@itsmotul.edu.mx$/',
        'password' => 'required',
        'numero' => 'required|unique:maestros|min:4|max:4|regex:/[0-9]/',
    ];

// ------------------------------------------------ resetear input maestro -----------------------------------------------
    public function resetInput(){
        //resetea validaciones
        $this->resetValidation();
        //limpia caja de texto
        $this->name = '';
        $this->last_name = '';
        $this->email = '';
        $this->password = '';
        $this->numero = '';
    }

// ------------------------------------------------ funciones para crear maestro ----------------------------------------
    public function submit(){
            
        $this->validate();

        $role='maestro';
        $user=new User;
        $user->name= $this->name;
        $user->last_name= $this->last_name;
        $user->email= $this->email;
        $user->password= Hash::make($this->password);
        $user->rol=$role;
        $user->save();
        
        $hasrole = New Model_has_role;
        $hasrole->role_id= 3;
        $hasrole->model_type='App\Models\User';
        $hasrole->model_id=$user->id;
        $hasrole->save();

        $maestro= new Maestro;
        $maestro->numero = $this->numero;
        $maestro->user_id=$user->id;
        $maestro->save();

        $this->mount();
        $this->cerrarmodal('#modal1');
        $this->resetInput();
        $this->emit('mensaje', 'Maestro creado correctamente', 'success');
    }

// --------------------------------------------------- funciones para editar maestro------------------------------------
    public function edit($id){
        $user = User::where('id','=',$id)->first();

        $this->user_id = $id;
        $this->name = $user->name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->numero = $user->maestro->numero;
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
            $this->emit('mensaje', 'Maestro actualizado correctamente', 'success');
        } 
    }

// --------------------------------------------------- funciones para eliminar admin----------------------------------
    public function destroye(User $userId, Maestro $maestroId){
        
        $tallers = Taller::where("maestro_id","=",$maestroId->id)->get();

        if($tallers->count() == 0){
            
            $modelhasroles = Model_has_role::where("model_id","=",$userId->id)->delete();
            $maestroId->delete();
            $userId->delete();

            $this->emit('mensaje', 'Maestro eliminado correcto', 'success');
        }else{
            $this->emit('mensaje', 'No se puede eliminar a este maestro por que imparte algún taller', 'error');
        }

        $this->mount();
        
        
    }

// --------------------------------------------------- funciones para cerrar modal ----------------------------------
    public function cerrarmodal($modal){
        $this->emit('SCreate', $modal);
    }

//  -----------------------------------------------------  monta la variable maestro -----------------------------------
    public function mount(){
        $this->tallers=Taller::All();
    }

    public function render()
    {
        return view('livewire.crud-maestro',[
            'admins' => User::where('rol','=','maestro')
                              ->where('name','LIKE','%'.$this->buscador.'%')
                              ->Paginate(5), 
        ]);
    }
}
