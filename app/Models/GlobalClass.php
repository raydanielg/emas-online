<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalClass extends Model
{
    protected $fillable = ['name', 'level'];

    public function schoolClasses()
    {
        return $this->hasMany(SchoolClass::class, 'global_class_id');
    }
}
