<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'tour_id',
        'tourist_id',
        'guide_id',
        'preferred_time',
        'date',
        'status',
        'notes',
    ];

    // Tour this booking is for
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    // Guide receiving the booking
    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }

    // Tourist who made the booking (from users table)
    public function tourist()
    {
        return $this->belongsTo(User::class, 'tourist_id');
    }
}
