<?php

namespace App\Http\Livewire\Staffadmin\Supervisors;

use App\Models\Supervisor;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class Edit extends Component
{
    use WithFileUploads;
    use Actions;

    public Supervisor $supervisor;
    public $staffid, $first_name, $last_name, $middle_name, $email, $birthdate, $gender, $phone1, $phone2, $nid, $address, $collage, $fns, $faculty_school, $department, $qualification, $picture, $newpicture;

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
            'staffid' => 'required|numeric|unique:supervisors,staffid,' . $this->supervisor->id,
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'middle_name' => 'nullable|max:20',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->supervisor->user->id,
            'birthdate' => 'required',
            'gender' => 'required',
            'phone1' => 'required|max:15',
            'phone2' => 'nullable|max:15',
            'nid' => 'required|string|max:20|unique:supervisors,nid,' . $this->supervisor->id,
            'address' => 'required|string|max:255',
            'collage' => 'required|string|max:255',
            'fns' => 'required|string',
            'faculty_school' => 'required|string|max:255',
            'department' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function save()
    {
        // Validate the fields before updating.
        $validatedData = $this->validate();
        if ($this->newpicture) {
            $this->validate(['newpicture' => 'required|mimes:webp,jpeg,jpg,png']);
        }

        // handle User Info.
        $name = $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name;
        $this->supervisor->user->name = $name;
        $this->supervisor->user->email = $this->email;
        $this->supervisor->user->save();

        // handle new picture upload
        if ($this->newpicture) {
            $path = base_path('assets\\supervisor\\' . $this->supervisor->picture);
            if (env('APP_ENV') == 'local') {
                $path = public_path('assets\\supervisor\\' . $this->supervisor->picture);
            }
            unlink($path);
            $pictureName = Str::random(8) . Carbon::now()->timestamp . '.' . $this->newpicture->extension();
            $this->newpicture->storeAs('supervisor', $pictureName);
            $this->supervisor->picture = $pictureName;
            $this->supervisor->save();
        }

        // update validated info
        $this->supervisor->update($validatedData);

        // handle notification
        $this->notification()->success(
            $title = 'Profile saved',
            $description = 'Your profile was successfull saved'
        );
        sleep(3);
        return redirect()->route('supervisors.index');
    }

    public function render()
    {
        return view('livewire.staffadmin.supervisors.edit');
    }
}