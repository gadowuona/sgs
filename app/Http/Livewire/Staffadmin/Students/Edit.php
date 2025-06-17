<?php

namespace App\Http\Livewire\Staffadmin\Students;

use App\Models\Student;
use Illuminate\Support\Facades\DB;
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
        $validatedData = $this->validate();

        DB::beginTransaction();

        try {
            // Update the related User
            $this->student->user->update([
                'name' => $this->full_name,
                'email' => $this->email,
            ]);

            // Update the Student model
            $this->student->update($validatedData);

            DB::commit();

            session()->flash('message', 'Student\'s details were successfully updated');
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->notification()->error(
                'Error',
                'Failed to update student: ' . $e->getMessage()
            );
        }
    }


    public function render()
    {
        return view('livewire.staffadmin.students.edit');
    }
}