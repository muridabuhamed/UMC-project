<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeePayment extends Model
{
    protected $fillable = [
        'student_id',
        'amount',
        'payment_date',
        'payment_method',
        'status',
        'reference_number',
        'remarks',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
