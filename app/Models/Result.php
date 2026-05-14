<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'subject',
        'marks_obtained',
        'total_marks',
        'percentage',
        'grade',
        'remarks',
        'exam_date',
    ];

    protected $casts = [
        'marks_obtained' => 'integer',
        'total_marks' => 'integer',
        'percentage' => 'float',
        'exam_date' => 'datetime',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }
}
