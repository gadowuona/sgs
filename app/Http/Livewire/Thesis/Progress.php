<?php

namespace App\Http\Livewire\Thesis;

use App\Models\Thesis;
use Livewire\Component;

class Progress extends Component
{
    public Thesis $thesis;

    public function render()
    {
        $completedEvents = $this->thesis->timelines()->pluck('event')->toArray();

        $milestones = collect([
            'Submission received',
            'Technical check',
            'Editorial assignment',
            'With editor',
            'Peer review',
        ])->map(fn($label) => [
            'label' => $label,
            'completed' => collect($completedEvents)->contains(fn($e) => str_contains(strtolower($e), strtolower($label))),
        ])->toArray();

        return view('livewire.thesis.progress', compact('milestones'));
    }
}
