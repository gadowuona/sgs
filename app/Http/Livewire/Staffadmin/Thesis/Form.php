<?php

namespace App\Http\Livewire\Staffadmin\Thesis;

use App\Mail\ThesisAssignStudent;
use App\Mail\ThesisAssignSupervisor;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\SupervisorThesis;
use App\Models\Thesis;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use WireUi\Traits\Actions;

class Form extends Component
{
    use Actions;

    public $title, $appointment_date, $supervisor, $co_supervisor, $student;

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'appointment_date' => 'required|date',
            'student' => 'required|exists:students,id',
            'supervisor' => 'required|exists:supervisors,id',
            'co_supervisor' => 'nullable|exists:supervisors,id',
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
        $thesis->appointment_date = $this->appointment_date;
        $thesis->save();

        // record new row for supervisor and co_supervisor
        if ($this->co_supervisor) {
            $co_supervisor = Supervisor::find($this->co_supervisor);
            $thesis->supervisors()->attach($co_supervisor, ['supervisor_status' => 'co-supervisor']);
        }
        $supervisor = Supervisor::find($this->supervisor);
        $thesis->supervisors()->attach($supervisor);

        // Send Supervisor and co-supervisor An assignment Mail
        foreach ($thesis->supervisors as $sup) {
            $supervisor_thesis = SupervisorThesis::where('thesis_id', $thesis->id)->where('supervisor_id', $sup->id)->first();
            $supervisor_thesis = SupervisorThesis::find($supervisor_thesis->id);
            Mail::to($sup->user->email)->send(new ThesisAssignSupervisor($sup, $supervisor_thesis));
        }

        // send Student an assign email
        $student = Student::find($this->student);
        Mail::to($student->email)->send(new ThesisAssignStudent($student));



        session()->flash('message', 'Thesis was successfully assigned to a supervisor');

        return redirect()->route('thesis.index');
    }

    public function render()
    {
        return view('livewire.staffadmin.thesis.form');
    }
}