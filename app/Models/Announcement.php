<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    protected $fillable = [
        'title',
        'description',
        'date',
    ];

    protected $casts = [
        'date' => 'date', // Cast date to a Carbon instance
    ];
}
