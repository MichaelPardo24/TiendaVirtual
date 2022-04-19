<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Hash;

class ShowUsers extends Component
{
    use WithPagination;

    //propiedades para crear un usuario
    public $names, $phone, $document, $email, $password;

    //Alerta que recibe si se crea, edita o elimina un usuario
    public $message = null;

    //cantidad de paginas
    public $pag = '10';

    //Buscador
    public $search = "";

    //Usuario a usar
    public $user;

    //organizacion de columnas de la tabla
    public $sort = 'id';
    public $dir = 'desc';

    //Abrir modales de edicion y eliminacion
    public $open_create = false;
    public $open_edit = false;
    public $open_destroy = false;

    //Cargar la vista livewire si esta en true
    public $readyToUpload = false;

    //Muestra estos datos al link a excepcionde los que se valido
    protected $queryString = [
        'pag' => ['except' => '10'],
        'search' => ['except' => ''],
        'sort' => ['except' => 'id'],
        'dir' => ['except' => 'desc']
    ];

    //Reglas para editar al user
    protected $rules = [
        'user.names' => 'required|min:8|max:40',
        'user.phone' => 'required|numeric|digits:10',
        'user.document' => 'required|numeric|digits_between:8,13',
        'user.email' => 'required|email|unique:users',
        'user.status' => 'required'
    ];

    //Recibe el llamado de render y ejecuta el metodo render
    protected $listeners = ['render'];

    //Al recibir los datos en $search actualiza la pagina
    public function updatingSearch()
    {
        $this->resetPage();
    }

    //Metodo que al recibir el llamado del div en la vista cambia la variable a true
    public function loadUsers()
    {
        $this->readyToUpload = true;
    }

    //Carga inicial del controlador
    public function render($message = null)
    {
        //si esta cargada la vista, se envian estos datos, si no no envia nada aun
        if ($this->readyToUpload) {
            $users = User::where('names', 'like', '%' . $this->search . '%')
                    ->orWhere('status', 'like', '%' . $this->search . '%')
                    ->orWhere('email', 'like', '%' . $this->search . '%')
                    ->orWhere('id', 'like', '%' . $this->search . '%')
                    ->orderBy($this->sort, $this->dir)
                    ->paginate($this->pag);
        } else {
            $users = [];
        }

        return view('livewire.user.show-users')->with(['users' => $users, 'message' => $this->message]);
    }

    //metodo para organizar las columnas de las tablas
    public function order($sort)
    {
        
        if ($this->sort == $sort) {
            if ($this->dir == 'desc') {
                $this->dir = 'asc';
            } else{
                $this->dir = 'desc';
            }
        } else{
            $this->sort = $sort;
        }
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName, [
            'names' => 'required|min:8|max:40',
            'phone' => 'required|numeric|digits:10',
            'document' => 'required|numeric|digits_between:8,13',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);
    }

    public function create()
    {
        $this->validate([
            'names' => 'required|min:8|max:40',
            'phone' => 'required|numeric|digits:10',
            'document' => 'required|numeric|digits_between:8,13',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        User::create([
            'names' => $this->names,
            'phone' => $this->phone,
            'document' => $this->document,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);

        $this->message = 'El usuario ' . $this->names . ' ha sido creado satisfactoriamente';
        $this->reset(['open_create', 'names', 'phone', 'document', 'email', 'password']);
    }

    //metodo que toma el parametro a nuestra variable $user y abre modal de edicion
    public function edit(User $user)
    {
        $this->user = $user;
        $this->open_edit = true;
    }

    //Metodo que actualiza los datos del usuario obtenido y cierra el modal
    public function update()
    {
        $this->user->save();
        $this->reset(['open_edit']);
        $this->message = 'El usuario ' . $this->user->names . ' ha sido actualizado satisfactoriamente';
    }

    public function closeAlert(){
        $this->message = Null;
    }


    //PARA EL QUE VAYA A LEER ESTO... iba a implementar un modal de eliminado pero me lo
    //rechazaron UnU aun asi decidi no eliminarlo totalmente asi que se puede implementar

    //metodo que toma el parametro a nuestra variable $user y abre modal de eliminacion
    public function destroy(User $user)
    {
        $this->user = $user;
        $this->open_destroy = true;
    }

    //Metodo que elimina los datos del usuario obtenido y cierra el modal
    public function confirmDestroy()
    {
        $this->user->delete();
        $this->reset(['open_destroy']);
        $this->message = 'El usuario ' . $this->user->names . ' ha sido eliminado satisfactoriamente';
    }

}