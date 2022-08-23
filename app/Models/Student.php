<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'index_number',
        'full_name',
        'email',
        'programme',
        'gender',
        'phone1',
        'phone2',
    ];

    public function thesis()
    {
        return $this->hasMany(Thesis::class);
    }
}