<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
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
        'department',
        'qualification',
        'picture',
        'super_status',
        'doa',
        'faculty',
        'school',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}