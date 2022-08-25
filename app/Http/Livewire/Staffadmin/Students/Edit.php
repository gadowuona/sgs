<?php

namespace App\Http\Livewire\Staffadmin\Students;

use App\Models\Student;
use Livewire\Component;
use WireUi\Traits\Actions;

class Edit extends Component
{
    use Actions;

    public Student $student;
    public $index_number, $full_name, $email, $programme, $gender, $phone1, $phone2;

    public function mount($student)
    {
        $this->index_number = $student->index_number;
        $this->full_name = $student->full_name;
        $this->email = $student->email;
        $this->programme = $student->programme;
        $this->gender = $student->gender;
        $this->phone1 = $student->phone1;
        $this->phone2 = $student->phone2;
    }

    protected function rules()
    {
        return [
            'index_number' => 'required|string|unique:students,index_number,' . $this->student->id,
            'full_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $this->student->id,
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
        $validatedData = $this->validate();

        // update validated info
        $this->student->update($validatedData);

        // handle notification
        // $this->notification()->success(
        //     $title = 'Student saved',
        //     $description = 'Student\'s details was successfull updated'
        // );
        // sleep(5);
        return redirect()->route('students.index');
    }

    public function render()
    {
        return view('livewire.staffadmin.students.edit');
    }
}