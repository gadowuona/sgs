<?php

namespace App\Http\Livewire\Staffadmin\Thesis;

use App\Mail\ThesisAssignStudent;
use App\Mail\ThesisAssignSupervisor;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\Thesis;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions;

    public $title, $submission_date, $due_date, $supervisor, $co_supervisor, $student;

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'submission_date' => 'required|date',
            'due_date' => 'required|date',
            'student' => 'required|exists:students,id',
            'supervisor' => 'required|exists:supervisors,id',
            'co_supervisor' => 'required|exists:supervisors,id',
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

        // create thesis
        $thesis = new Thesis;
        $thesis->student_id = $this->student;
        $thesis->title = $this->title;
        $thesis->submission_date = $this->submission_date;
        $thesis->due_date = $this->due_date;
        $thesis->save();

        // record row for columns
        $co_supervisor = Supervisor::find($this->co_supervisor);
        $thesis->supervisors()->attach($co_supervisor, ['supervisor_status' => 'co-supervisor']);
        $supervisor = Supervisor::find($this->supervisor);
        $thesis->supervisors()->attach($supervisor);

        // Send Supervisor and co-supervisor An assignment Mail
        foreach ([$supervisor, $co_supervisor] as $sup) {
            Mail::to($sup->user->email)->send(new ThesisAssignSupervisor($sup));
        }

        // send Student an assign email
        $student = Student::find($this->student);
        Mail::to($student)->send(new ThesisAssignStudent($student,));


        // handle notification
        $this->notification()->success(
            $title = 'Thesis Assigned',
            $description = 'Thesis was successfully assigned to a supervisor'
        );
        sleep(3);

        return redirect()->route('thesis.index');
    }

    public function render()
    {
        return view('livewire.staffadmin.thesis.form');
    }
}