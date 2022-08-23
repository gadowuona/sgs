<?php

namespace App\Mail;

use App\Models\Supervisor;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SupervisorRegistration extends Mailable
{
    use Queueable, SerializesModels;

    public Supervisor $supervisor;
    public $password;

    // public 
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($supervisor, $password)
    {
        $this->supervisor = $supervisor;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.supervisors-registation');
    }
}