<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = ['title', 'type', 'subject_id', 'file_path', 'url', 'description'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
