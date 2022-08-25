<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use WireUi\Traits\Actions;

use Illuminate\Validation\Rules;

class Form extends Component
{
    use Actions;

    public $name, $email, $password, $password_confirmation, $role;

    protected function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password_confirmation' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required'],
        ];
    }

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        // Validate the fields before updating.
        $this->validate();

        // $password = Str::random(8);

        // create user
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        // TODO:: send mail to user info

       

        session()->flash('message', 'User was successfully saved');
        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.admin.users.form');
    }
}