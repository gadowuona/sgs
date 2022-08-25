<?php

namespace App\Http\Livewire\Staffadmin\Thesis;

use App\Models\Thesis;
use Livewire\Component;

class DeleteButton extends Component
{
    public Thesis $thesis;

    public function deletThesis($thesis_id)
    {
        $thesis = Thesis::find($thesis_id);
        $thesis->delete();
        session()->flash('message', 'Thesis has been deleted succefully!');
        return redirect()->route('thesis.index');
    }

    public function render()
    {
        return view('livewire.staffadmin.thesis.delete-button');
    }
}
