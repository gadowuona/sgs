<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisorThesis extends Model
{
    use HasFactory;

    protected $table = 'supervisor_thesis';

    public function thesis()
    {
        return $this->belongsTo(Thesis::class);
    }
}