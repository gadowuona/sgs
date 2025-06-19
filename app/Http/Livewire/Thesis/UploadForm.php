<?php

namespace App\Http\Livewire\Thesis;

use App\Models\Thesis;
use App\Models\ThesisAmendment;
use App\Models\ThesisTimeline;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadForm extends Component
{
    use WithFileUploads;

    public Thesis $thesis;
    public $file;

    protected $rules = [
        'file' => 'required|mimes:pdf|max:10240', // max 10MB
    ];

    public function submit()
    {
        $this->validate();

        try {
            DB::beginTransaction();
            $filePath = "theses/{$this->thesis->id}/thesis.pdf";

            // Overwrite file
            Storage::put($filePath, $this->file->get());

            // Update or create amendment
            ThesisAmendment::updateOrCreate(
                ['thesis_id' => $this->thesis->id],
                [
                    'file_path' => $filePath,
                    'type' => 'amendment',
                    'status' => 'submitted',
                    'submitted_at' => now(),
                    'reviewed_by' => null,
                    'reviewed_at' => null,
                    'supervisor_feedback' => null,
                ]
            );

            // Log to timeline
            ThesisTimeline::create([
                'thesis_id' => $this->thesis->id,
                'event' => 'Amendment uploaded',
                'note' => 'Student submitted a new version',
                'event_date' => now(),
            ]);
            DB::commit();

            session()->flash('message', 'File uploaded successfully and sent for review.');
            $this->reset('file');
        } catch (Exception $e) {
            DB::rollBack();
            session()->flash('error', 'Failed to upload file: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.thesis.upload-form');
    }
}
