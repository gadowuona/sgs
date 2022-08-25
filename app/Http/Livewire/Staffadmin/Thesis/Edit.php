<?php

namespace App\Http\Livewire\Staffadmin\Thesis;

use App\Models\Thesis;
use Livewire\Component;
use WireUi\Traits\Actions;

class Edit extends Component
{
    use Actions;

    public Thesis $thesis;
    public $title, $submission_date, $due_date;

    public function mount($thesis)
    {
        $this->title = $thesis->title;
        $this->submission_date = $thesis->submission_date;
        $this->due_date = $thesis->due_date;
        $this->student = $thesis->student;
        $this->supervisor = $thesis->supervisor;
        $this->co_supervisor = $thesis->co_supervisor;
    }

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'submission_date' => 'required|date',
            'due_date' => 'required|date',
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
        $this->thesis->update($validatedData);

        session()->flash('message', 'Thesis infomation was successfully updated !');

        return redirect()->route('thesis.index');
    }
    public function render()
    {
        return view('livewire.staffadmin.thesis.edit');
    }
}