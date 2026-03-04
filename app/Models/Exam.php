<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $fillable = [
        'name',
        'type',
        'school_id',
        'academic_year_id',
        'term',
        'start_date',
        'end_date',
        'is_active',
        'is_published',
        'description'
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function academicYear()
    {
        return $this->belongsTo(AcademicYear::class);
    }
}
