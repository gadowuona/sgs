<?php

namespace App\Http\Livewire\Thesis;

use App\Models\Thesis;
use Livewire\Component;

class Timeline extends Component
{
    public Thesis $thesis;

    public function render()
    {
        $timeline = $this->thesis->timelines()->orderBy('event_date')->get();

        // Group by artificial stages
        $timelineGroups = $timeline->groupBy(function ($item) {
            return $this->mapToStage($item->event);
        });

        return view('livewire.thesis.timeline', compact('timelineGroups'));
    }

    protected function mapToStage($event)
    {
        return match (true) {
            str_contains($event, 'technical') => 'Technical check',
            str_contains($event, 'editorial') => 'Editorial assignment',
            str_contains($event, 'editor') => 'With editor',
            str_contains($event, 'review') => 'Peer review',
            default => 'Other',
        };
    }
}
