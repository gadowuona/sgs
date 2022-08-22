<?php

namespace App\Http\Livewire\Staffadmin\Thesis;

use Livewire\Component;

class Form extends Component
{
    public $title, $sudmission_date, $due_date, $supervisor, $co_supervisor;

    public function save()
    {
        dd($this->supervisor);
    }

    public function render()
    {
        return view('livewire.staffadmin.thesis.form');
    }
}