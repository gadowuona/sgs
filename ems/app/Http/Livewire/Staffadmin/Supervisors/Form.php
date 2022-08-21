<?php

namespace App\Http\Livewire\Staffadmin\Supervisors;

use App\Mail\SupervisorRegistration;
use App\Models\supervisor;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Form extends Component
{
    use WithFileUploads;

    public $staffid, $first_name, $last_name, $middle_name, $email, $birthdate, $gender, $phone1, $phone2, $nid, $address, $collage, $fns, $faculty_school, $department, $qualification, $picture;


    protected function rules()
    {
        return [
            'staffid' => 'required|numeric|unique:supervisors',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'middle_name' => 'nullable|max:20',
            'email' => 'required|string|email|max:255|unique:users',
            'birthdate' => 'required',
            'gender' => 'required',
            'phone1' => 'required|max:15',
            'phone2' => 'nullable|max:15',
            'nid' => 'required|string|max:20|unique:supervisors',
            'address' => 'required|string|max:255',
            'collage' => 'required|string|max:255',
            'fns' => 'required|string',
            'faculty_school' => 'required|string|max:255',
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

        // handle name and password genreate
        $name = $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
        $password = Str::random(8);

        // handle picture upload
        $pictureName = Str::random(8) . Carbon::now()->timestamp . '.' . $this->picture->extension();
        $this->picture->storeAs('supervisor', $pictureName);

        // create user
        $user = User::create([
            'name' => $name,
            'email' => $this->email,
            'password' => Hash::make($password),
        ]);

        // create supervisor
        $supervisor = supervisor::create([
            'user_id' => $user->id,
            'staffid' => $this->staffid,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'birthdate' => $this->birthdate,
            'gender' => $this->gender,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
            'nid' => $this->nid,
            'address' => $this->address,
            'collage' => $this->collage,
            'fns' => $this->fns,
            'faculty_school' => $this->faculty_school,
            'department' => $this->department,
            'qualification' => $this->qualification,
            'picture' => $pictureName,
        ]);

        // Send Supervisor Mail
        Mail::to($user->email)->send(new SupervisorRegistration($supervisor, $password));

        return redirect()->route('supervisors.index');
    }


    public function render()
    {
        return view('livewire.staffadmin.supervisors.form');
    }
}