<?php

namespace App\Http\Livewire\Thesis;

use App\Models\Thesis;
use App\Models\ThesisAmendment;
use App\Models\ThesisTimeline;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ReviewForm extends Component
{
    use WithFileUploads;

    public Thesis $thesis;
    public ?ThesisAmendment $amendment = null;

    public string $status, $feedback;
    public $reviewFile = null;

    protected $rules = [
        'status' => 'required|in:accepted,changes-requested',
        'feedback' => 'required|string|max:5000',
        'reviewFile' => 'nullable|file|mimes:pdf,docx|max:10240',
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

            $reviewPath = null;
            if ($this->reviewFile) {
                $reviewPath = $this->reviewFile->storeAs(
                    "theses/{$this->thesis->id}/reviews",
                    now()->timestamp . '_review.' . $this->reviewFile->getClientOriginalExtension(),
                    'public'
                );
            }

            $this->amendment->update([
                'status' => $this->status,
                'reviewed_by' => optional(auth()->user()->supervisor)->id,
                'reviewed_at' => now(),
                'supervisor_feedback' => $this->feedback,
                'supervisor_file_path' => $reviewPath,
            ]);

            ThesisTimeline::create([
                'thesis_id' => $this->thesis->id,
                'event' => $this->status === 'accepted' ? 'Submission accepted' : 'Amendment requested',
                'note' => $this->feedback,
                'event_date' => now(),
            ]);

            DB::commit();

            session()->flash('message', 'Review submitted successfully!');
            return redirect()->route(Auth::user()->role === 'STF' ? 'staff.thesis.show' : 'theses.show', $this->thesis->id);
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to submit review: ' . $e->getMessage());
        }
    }


    public function download()
    {
        $path = $this->amendment->file_path;

        if (!$path || !Storage::disk('public')->exists($path)) {
            session()->flash('error', 'File not found or no longer exists.');
            return redirect()->back();
        }

        return Storage::disk('public')->download($path);
    }


    public function render()
    {
        return view('livewire.thesis.review-form');
    }
}
