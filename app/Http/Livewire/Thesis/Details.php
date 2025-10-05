<?php

namespace App\Http\Livewire\Thesis;

use App\Models\Thesis;
use Livewire\Component;

class Details extends Component
{

    public Thesis $thesis;

    public function mount(Thesis $thesis)
    {
        $this->thesis = $thesis;
    }

    public function render()
    {
        return view('livewire.thesis.details');
    }
}
