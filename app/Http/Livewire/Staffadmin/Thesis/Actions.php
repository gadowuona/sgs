<?php

namespace App\Http\Livewire\Staffadmin\Thesis;

use App\Models\Thesis;
use Livewire\Component;

class Actions extends Component
{
    public Thesis $thesis;

    public function updateThesisCompleteStatus($thesis_id, $status)
    {
        $thesis = Thesis::find($thesis_id);
        $thesis->complete_status = $status;
        $thesis->save();
        session()->flash('message', 'Thesis Payment status has been updated succefully');
        return redirect()->route('thesis.show', $thesis->id);
    }

    public function updateThesisPaidStatus($thesis_id, $status)
    {
        $thesis = Thesis::find($thesis_id);
        $thesis->payment_status = $status;
        $thesis->save();
        session()->flash('message', 'Thesis Payment status has been updated succefully');
        return redirect()->route('thesis.show', $thesis->id);
    }
    public function render()
    {
        return view('livewire.staffadmin.thesis.actions');
    }
}