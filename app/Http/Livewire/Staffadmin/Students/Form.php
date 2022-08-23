<?php

namespace App\Http\Livewire\Staffadmin\Students;

use App\Models\Student;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions;

    public $index_number, $full_name, $email, $programme, $gender, $phone1, $phone2;


    protected function rules()
    {
        return [
            'index_number' => 'required|string|unique:students',
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'programme' => 'required|string|max:255',
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

        // create Student
        Student::create([
            'index_number' => strtoupper($this->index_number),
            'full_name' => $this->full_name,
            'email' => $this->email,
            'programme' => strtoupper($this->programme),
            'gender' => $this->gender,
            'phone1' => $this->phone1,
            'phone2' => $this->phone2,
        ]);

        // handle notification
        $this->notification()->success(
            $title = 'Student saved',
            $description = 'Student\'s details was successfull saved'
        );
        sleep(5);
        return redirect()->route('students.index');
    }


    public function render()
    {
        return view('livewire.staffadmin.students.form');
    }
}