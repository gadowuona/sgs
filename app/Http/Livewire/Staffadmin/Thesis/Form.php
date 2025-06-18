<?php

namespace App\Http\Livewire\Staffadmin\Thesis;

use App\Mail\ThesisAssignStudent;
use App\Mail\ThesisAssignSupervisor;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\SupervisorThesis;
use App\Models\Thesis;
use Exception;
use Illuminate\Support\Facades\DB;
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

        DB::beginTransaction();

        try {
            // create thesis
            $thesis = new Thesis;
            $thesis->student_id = $this->student;
            $thesis->title = $this->title;
            $thesis->appointment_date = $this->appointment_date;
            $thesis->save();

            // Attach supervisor
            $supervisor = Supervisor::findOrFail($this->supervisor);
            $thesis->supervisors()->attach($supervisor, ['supervisor_status' => 'supervisor']);

            // Attach co-supervisor if provided
            if ($this->co_supervisor) {
                $coSupervisor = Supervisor::findOrFail($this->co_supervisor);
                $thesis->supervisors()->attach($coSupervisor, ['supervisor_status' => 'co-supervisor']);
            }
            // Commit the DB transaction before sending mails
            DB::commit();


            // Send emails to supervisors
            foreach ($thesis->supervisors as $sup) {
                $pivot = $sup->pivot;
                Mail::to($sup->user->email)->send(new ThesisAssignSupervisor($sup, $pivot));
            }

            // Send Supervisor and co-supervisor An assignment Mail
            // foreach ($thesis->supervisors as $sup) {
            //     $supervisor_thesis = SupervisorThesis::where('thesis_id', $thesis->id)->where('supervisor_id', $sup->id)->first();
            //     $supervisor_thesis = SupervisorThesis::find($supervisor_thesis->id);
            //     Mail::to($sup->user->email)->send(new ThesisAssignSupervisor($sup, $supervisor_thesis));
            // }

            // Send email to student
            $student = Student::findOrFail($this->student);
            Mail::to($student->email)->send(new ThesisAssignStudent($student));

            // flash message
            session()->flash('message', 'Thesis was successfully assigned to a supervisor');
            return redirect()->route('thesis.index');
        } catch (Exception $e) {
            DB::rollBack();

            // Optionally log the error
            // Log::error($e);

            $this->notification()->error(
                'Error',
                'Failed to assign thesis: ' . $e->getMessage()
            );
        }
    }

    public function render()
    {
        return view('livewire.staffadmin.thesis.form');
    }
}