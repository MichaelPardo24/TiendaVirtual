<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;

class EditUser extends Component
{
    public $user;
    public $open = false;
    protected $rules = [
        'user.name' => 'required|min:8|max:25',
        'user.status' => 'required',
        'user.email' => 'required|email|unique:users',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
    }
    public function render()
    {
        return view('livewire.user.edit-user');
    }

    public function save()
    {
        $this->user->save();
        $this->reset(['open']);
        $this->emit('render');
    }
}
