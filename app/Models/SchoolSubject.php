<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolSubject extends Model
{
    protected $fillable = ['school_id', 'subject_id', 'school_class_id', 'subject_teacher_id'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function teacher()
    {
        return $this->belongsTo(SubjectTeacher::class, 'subject_teacher_id');
    }
}
