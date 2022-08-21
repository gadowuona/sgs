<?php

namespace App\Http\Livewire\Staffadmin\Students;

use App\Models\Student;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions;

    public $index_number, $first_name, $last_name, $middle_name, $email, $programme, $gender, $phone1, $phone2;


    protected function rules()
    {
        return [
            'index_number' => 'required|string|unique:students',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'middle_name' => 'nullable|max:20',
            'email' => 'required|string|email|max:255|unique:students',
            'programme' => 'required|max:255',
            'gender' => 'required',
            'phone1' => 'required|max:15',
            'phone2' => 'nullable|max:15',
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

        // create supervisor
        Student::create([
            'index_number' => strtoupper($this->index_number),
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'middle_name' => $this->middle_name,
            'email' => $this->email,
            'programme' => $this->programme,
            'gender' => $this->gender,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
        ]);

        // handle notification
        $this->notification()->success(
            $title = 'Student saved',
            $description = 'Student\'s details was successfull saved'
        );
        sleep(3);

        return redirect()->route('students.index');
    }


    public function render()
    {
        return view('livewire.staffadmin.students.form');
    }
}