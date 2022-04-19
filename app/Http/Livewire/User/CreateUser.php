<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class CreateUser extends Component
{
    use WithFileUploads;
    public $open = false;
    public $names, $phone, $direction, $document, $email, $password, $message;
    protected $rules = [
        'names' => 'required|min:8|max:40',
        'phone' => 'required|numeric|digits_between:9,11',
        'document' => 'required|numeric|digits_between:10,20',
        'direction' => 'required|max:80',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:8'
    ];

    public function render()
    {
        return view('livewire.user.create-user');
    }

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function save()
    {
        $this->validate();
        User::create([
            'names' => $this->names,
            'phone' => $this->phone,
            'document' => $this->document,
            'direction' => $this->direction,
            'email' => $this->email,
            'password' => Hash::make($this->password)
        ]);
        $this->reset(['open', 'names', 'phone', 'document', 'direction', 'email', 'password']);
        $this->message = 'El usuario ' . $this->names . ' ha sido creado satisfactoriamente';
        $this->emit('render', $this->message);
    }
}
