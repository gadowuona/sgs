<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'title',
        'appointment_date',
    ];

    public function supervisors()
    {
        return $this->belongsToMany(Supervisor::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function supervisor_thesis()
    {
        return $this->hasMany(SupervisorThesis::class);
    }

    public function amendment()
    {
        return $this->hasMany(ThesisAmendment::class);
    }

    public function latestAmendment()
    {
        return $this->hasOne(ThesisAmendment::class)->latestOfMany();
    }

    public function timelines()
    {
        return $this->hasMany(ThesisTimeline::class)->latest('event_date');
    }
}
