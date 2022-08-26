<?php

namespace App\Mail;

use App\Models\Supervisor;
use App\Models\SupervisorThesis;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThesisPaymentSupervisor extends Mailable
{
    use Queueable, SerializesModels;

    public Supervisor $supervisor;
    public SupervisorThesis $supervisor_thesis;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($supervisor, $supervisor_thesis)
    {
        $this->supervisor = $supervisor;
        $this->supervisor_thesis = $supervisor_thesis;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.thesis-payment-supervisor');
    }
}