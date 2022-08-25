<?php

namespace App\Mail;

use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ThesisAssignStudent extends Mailable
{
    use Queueable, SerializesModels;

    public Student $student;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($student)
    {
        dd($student->thesis);
        $this->student = $student;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.thesis-assign-student');
    }
}