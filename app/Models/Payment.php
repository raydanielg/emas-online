<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'transaction_id',
        'school_id',
        'amount',
        'plan_name',
        'status',
        'payment_method',
        'paid_at',
    ];

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
