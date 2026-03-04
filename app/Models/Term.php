<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Term extends Model
{
    protected $fillable = ['name', 'is_current', 'school_id'];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
