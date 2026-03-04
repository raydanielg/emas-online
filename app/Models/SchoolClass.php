<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $fillable = ['global_class_id', 'school_id', 'teacher_id'];

    public function globalClass()
    {
        return $this->belongsTo(GlobalClass::class, 'global_class_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_level', 'name');
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }
}
