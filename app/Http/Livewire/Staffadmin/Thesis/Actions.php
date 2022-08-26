<?php

namespace App\Http\Livewire\Staffadmin\Thesis;

use App\Mail\ThesisPaymentSupervisor;
use App\Models\SupervisorThesis;
use App\Models\Thesis;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class Actions extends Component
{
    public Thesis $thesis;

    public function updateThesisCompleteStatus($thesis_id, $status)
    {
        $thesis = Thesis::find($thesis_id);
        $thesis->complete_status = $status;
        $thesis->save();
        session()->flash('message', 'Thesis completion status has been updated succefully');
        return redirect()->route('thesis.show', $thesis->id);
    }

    // finance 
    public function updateThesisPaidStatus($thesis_id, $status)
    {
        $thesis = Thesis::find($thesis_id);
        $thesis->payment_status = $status;
        $thesis->save();

        if ($thesis->payment_status === 'paid') {
            // Send Supervisor and co-supervisor An assignment Mail
            foreach ($thesis->supervisors as $sup) {
                $supervisor_thesis = SupervisorThesis::where('thesis_id', $thesis->id)->where('supervisor_id', $sup->id)->first();
                $supervisor_thesis = SupervisorThesis::find($supervisor_thesis->id);
                Mail::to($sup->user->email)->send(new ThesisPaymentSupervisor($sup, $supervisor_thesis));
            }
        }

        session()->flash('message', 'Thesis Payment status has been updated succefully');
        return redirect()->route('finance.thesis.show', $thesis->id);
    }
    public function render()
    {
        return view('livewire.staffadmin.thesis.actions');
    }
}