<?php

namespace App\Http\Livewire\Staffadmin\Thesis;

use App\Models\Thesis;
use Livewire\Component;

class Form extends Component
{
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
        $thesis = Thesis::create([
            'student_id' => $this->student,
            'title' => $this->title,
            'submission_date' => $this->submission_date,
            'due_date' => $this->due_date,
        ]);

        dd($thesis->supervisor);
    }

    public function render()
    {
        return view('livewire.staffadmin.thesis.form');
    }
}