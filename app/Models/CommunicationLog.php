<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Student;
use App\Models\User;

class CommunicationLog extends Model
{
    protected $fillable = [
        'student_id',
        'user_id',
        'contact_date',
        'contact_type',
        'subject',
        'notes',
        'mood',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
