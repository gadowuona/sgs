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
        'submission_date',
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
}