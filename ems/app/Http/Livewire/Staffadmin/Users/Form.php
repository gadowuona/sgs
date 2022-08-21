<?php

namespace App\Http\Livewire\Staffadmin\Users;

use App\Models\Profile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $staffid, $first_name, $last_name, $middle_name, $email, $birthdate, $gender, $phone1, $phone2, $nid, $address, $collage, $fns, $faculty, $department, $qualification, $picture;


    protected function rules()
    {
        return [
            'staffid' => 'required|numeric|unique:profiles',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'middle_name' => 'nullable|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'birthdate' => 'required',
            'gender' => 'required',
            'phone1' => 'required|max:15',
            'phone2' => 'nullable|max:15',
            'nid' => 'required|string|max:20|unique:profiles',
            'address' => 'required|string|max:255',
            'collage' => 'required|string|max:255',
            'fns' => 'required|string',
            'faculty' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'picture' => 'required|mimes:webp,jpeg,jpg,png',
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

        $name = $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
        $password = Str::random(8);

        // handle picture upload
        $pictureName = Str::random(8) . Carbon::now()->timestamp . '.' . $this->picture->extension();
        $this->picture->storeAs('profile', $pictureName);

        // dd($password);
        // create user
        $user = User::create([
            'name' => $name,
            'email' => $this->email,
            'password' => Hash::make($password),
        ]);

        // create profile
        $profile = Profile::create([
            'user_id' => $user->id,
            'staffid' => $this->staffid,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'email' => $this->email,
            'birthdate' => $this->birthdate,
            'gender' => $this->gender,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'nid' => $this->nid,
            'address' => $this->address,
            'collage' => $this->collage,
            'fns' => $this->fns,
            'faculty' => $this->faculty,
            'department' => $this->department,
            'qualification' => $this->qualification,
            'picture' => $pictureName,
        ]);

        return redirect()->route('users.index');
    }

    public function render()
    {
        return view('livewire.staffadmin.users.form');
    }
}