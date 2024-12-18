<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BorrowedEquipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'equipment_id',
        'user_id',
        'borrowed_date',
        'status',
    ];

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
