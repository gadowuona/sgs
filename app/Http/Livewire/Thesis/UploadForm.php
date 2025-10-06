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
        'file' => 'required|mimes:pdf,doc,docx|max:10240', // 10MB max
    ];

    public function updatedFile()
    {
        $this->validateOnly('file');
    }


    public function submit()
    {
        $this->validate();

        try {
            DB::beginTransaction();

            $directory = "theses/{$this->thesis->id}";
            $filename = 'upload-' . now()->timestamp . '.' . $this->file->getClientOriginalExtension();
            $filePath = $this->file->storeAs($directory, $filename, 'public');
            // Update or create amendment
            $thesisAmendment = ThesisAmendment::create([
                'thesis_id' => $this->thesis->id,
                'file_path' => $filePath,
                'type' => $this->thesis->amendments()->count() === 0 ? 'initial' : 'amendment',
                'status' => 'submitted',
                'submitted_at' => now(),
            ]);

            // Log to timeline
            $thesisTimeline = ThesisTimeline::create([
                'thesis_id' => $this->thesis->id,
                'event' => 'Amendment uploaded',
                'note' => 'Student submitted a new version',
                'event_date' => now(),
            ]);
            DB::commit();
            // dd($thesisAmendment, $thesisTimeline);

            session()->flash('message', 'File uploaded successfully and sent for review.');
            $this->reset('file');
            return redirect()->back();
        } catch (Exception $e) {

            dd($e->getMessage());
            DB::rollBack();
            session()->flash('error', 'Failed to upload file: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.thesis.upload-form');
    }
}
