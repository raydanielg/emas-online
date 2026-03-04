<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'admission_number',
        'gender',
        'date_of_birth',
        'school_id',
        'class_level',
        'status',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }
}
