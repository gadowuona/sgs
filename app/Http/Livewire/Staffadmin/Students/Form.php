<?php

namespace App\Http\Livewire\Staffadmin\Students;

use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\DB;
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

        DB::beginTransaction();

        try {
            // Create User
            $user = User::updateOrCreate(
                [
                    'email' => $this->email,
                    'role' => 'STF',
                ],
                [
                    'name' => $this->full_name,
                    'password' => bcrypt(strtolower($this->index_number)),
                ]
            );

            // Create Student
            Student::updateOrCreate([
                'index_number' => strtoupper($this->index_number),
                'email' => $this->email,
            ], [
                'user_id' => $user->id,
                'full_name' => $this->full_name,
                'programme' => strtoupper($this->programme),
                'gender' => $this->gender,
                'phone1' => $this->phone1,
                'phone2' => $this->phone2,
            ]);

            DB::commit();

            session()->flash('message', 'Student\'s details was successfully created');
            return redirect()->route('students.index');
        } catch (\Exception $e) {
            DB::rollBack();
            $this->notification()->error(
                $title = 'Error',
                $description = 'Failed to create student: ' . $e->getMessage()
            );
        }
    }


    public function render()
    {
        return view('livewire.staffadmin.students.form');
    }
}