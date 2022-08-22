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
        'due_date',
    ];

    public function supervisor()
    {
        return $this->belongsToMany(Supervisor::class);
    }
}