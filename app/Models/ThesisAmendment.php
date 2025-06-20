<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThesisAmendment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function thesis()
    {
        return $this->belongsTo(Thesis::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(Supervisor::class, 'reviewed_by');
    }
}
