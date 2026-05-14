<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'location',
        'category',
        'is_published',
    ];

    protected $casts = [
        'event_date' => 'datetime',
        'is_published' => 'boolean',
    ];
}
