<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'staffid',
        'first_name',
        'middle_name',
        'last_name',
        'birthdate',
        'gender',
        'phone1',
        'phone2',
        'nid',
        'address',
        'collage',
        'fns',
        'faculty_school',
        'department',
        'qualification',
        'picture',
        'doa',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thesis()
    {
        return $this->belongsToMany(Thesis::class);
    }
}