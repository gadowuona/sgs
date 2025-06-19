<?php

namespace App\Http\Livewire\ThesisAmendment;

use App\Models\ThesisAmendment;
use App\Models\ThesisTimeline;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Form extends Component
{

    public $uploadedFile, $note;

    protected function rules()
    {
        return [
            'uploadedFile' => 'nullable|file|mimes:pdf|max:10240',
        ];
    }
    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function submitAmendment()
    {
        // Validate the fields before updating.
        $this->validate();

        DB::beginTransaction();

        try {
            $path = 'theses/' . $this->thesis->id . '/submission.pdf';
            Storage::putFileAs('theses/' . $this->thesis->id, $this->uploadedFile, 'submission.pdf');

            ThesisAmendment::create([
                'thesis_id' => $this->thesis->id,
                'type' => 'amendment',
                'file_path' => $path,
                'submitted_at' => now(),
            ]);

            ThesisTimeline::create([
                'thesis_id' => $this->thesis->id,
                'event' => 'Amendment submitted',
                'note' => 'Student submitted a new amendment.',
            ]);
            // Commit the DB transaction
            DB::commit();
            session()->flash('message', 'Amendment submitted successfully.');

            // return redirect()->route('thesis.index');
        } catch (Exception $e) {
            DB::rollBack();
            $this->addError('upload', 'Failed to submit amendment.');
        }
    }

    public function requestChanges()
    {
        $this->reviewThesis();
        DB::beginTransaction();

        try {
            // Save note
            ThesisAmendment::create([
                'thesis_id' => $this->thesis->id,
                'submitted_by' => auth()->id(),
                'note' => $this->note,
                'status' => 'changes-requested',
            ]);

            ThesisTimeline::create([
                'thesis_id' => $this->thesis->id,
                'stage' => 'Review',
                'status' => 'Amendment requested',
                'date' => now(),
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            $this->addError('upload', 'Failed to submit amendment.');
        }
    }


    public function reviewThesis()
    {
        $this->validate(['note' => 'required|string|min:5']);
    }

    public function markAccepted()
    {
        $this->reviewThesis();
        DB::beginTransaction();

        try {
            ThesisAmendment::create([
                'thesis_id' => $this->thesis->id,
                'submitted_by' => auth()->id(),
                'note' => $this->note,
                'status' => 'accepted',
            ]);

            ThesisTimeline::create([
                'thesis_id' => $this->thesis->id,
                'stage' => 'Review',
                'status' => 'Accepted',
                'date' => now(),
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            $this->addError('upload', 'Failed to submit amendment.');
        }
    }

    public function render()
    {
        return view('livewire.thesis-amendment.form');
    }
}
