<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = [
        'name',
        'student_number',
        'department_id',
        'year',
    ];

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
}