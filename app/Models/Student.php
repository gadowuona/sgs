<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'index_number',
        'full_name',
        'email',
        'programme',
        'gender',
        'phone1',
        'phone2',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function thesis()
    {
        return $this->hasOne(Thesis::class);
    }
}