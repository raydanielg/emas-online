<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GradeScale extends Model
{
    protected $fillable = ['grade', 'min_score', 'max_score', 'remark', 'school_id'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
