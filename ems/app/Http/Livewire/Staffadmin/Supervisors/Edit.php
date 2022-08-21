<?php

namespace App\Http\Livewire\Staffadmin\Supervisors;

use App\Models\Supervisor;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $staffid, $first_name, $last_name, $middle_name, $email, $birthdate, $gender, $phone1, $phone2, $nid, $address, $collage, $fns, $faculty_school, $department, $qualification, $picture;

    public function mount($supervisor)
    {
        $this->staffid = $supervisor->staffid;
        $this->first_name = $supervisor->first_name;
        $this->last_name = $supervisor->last_name;
        $this->middle_name = $supervisor->middle_name;
        $this->email = $supervisor->user->email;
        $this->birthdate = $supervisor->birthdate;
        $this->gender = $supervisor->gender;
        $this->phone1 = $supervisor->phone1;
        $this->phone2 = $supervisor->phone2;
        $this->nid = $supervisor->nid;
        $this->address = $supervisor->address;
        $this->collage = $supervisor->collage;
        $this->fns = $supervisor->fns;
        $this->faculty_school = $supervisor->faculty_school;
        $this->department = $supervisor->department;
        $this->qualification = $supervisor->qualification;
        $this->picture = $supervisor->picture;
    }

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

        $name = $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
        $password = Str::random(8);

        // handle picture upload
        $pictureName = Str::random(8) . Carbon::now()->timestamp . '.' . $this->picture->extension();
        $this->picture->storeAs('supervisor', $pictureName);

        // create supervisor
        $supervisor = Supervisor::create([
            // 'user_id' => $user->id,
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
            'faculty_school' => $this->faculty_school,
            'department' => $this->department,
            'qualification' => $this->qualification,
            'picture' => $pictureName,
        ]);

        return redirect()->route('supervisors.index');
    }

    public function render()
    {
        return view('livewire.staffadmin.supervisors.edit');
    }
}