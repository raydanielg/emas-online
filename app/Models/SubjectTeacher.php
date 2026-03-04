<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectTeacher extends Model
{
    protected $fillable = ['name', 'phone', 'initials', 'school_id'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function assignments()
    {
        return $this->hasMany(SchoolSubject::class, 'subject_teacher_id');
    }
}
