<?php

namespace App\Http\Livewire\Thesis;

use App\Models\Thesis;
use App\Models\ThesisAmendment;
use App\Models\ThesisTimeline;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class ReviewForm extends Component
{

    public Thesis $thesis;
    public ThesisAmendment $amendment;

    public string $status, $feedback;

    protected $rules = [
        'status' => 'required|in:accepted,changes-requested',
        'feedback' => 'required|string|max:5000',
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields);
    }

    public function mount(Thesis $thesis)
    {
        $this->thesis = $thesis;
        $this->amendment = $thesis->latestAmendment;
    }

    public function submit()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $this->amendment->update([
                'status' => $this->status,
                'reviewed_by' => auth()->user()->supervisor->id ?? null,
                'reviewed_at' => now(),
                'supervisor_feedback' => $this->feedback,
            ]);

            ThesisTimeline::create([
                'thesis_id' => $this->thesis->id,
                'event' => $this->status === 'accepted' ? 'Submission accepted' : 'Amendment requested',
                'note' => $this->feedback,
                'event_date' => now(),
            ]);

            DB::commit();

            session()->flash('message', 'Review submitted successfully!');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to submit review: ' . $e->getMessage());
        }
    }


    public function download()
    {
        return Storage::download($this->amendment->file_path);
    }



    public function render()
    {
        return view('livewire.thesis.review-form');
    }
}
