<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'index_number',
        'first_name',
        'middle_name',
        'last_name',
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