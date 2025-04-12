<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_id',
        'tour_id',
        'guide_id',
        'tourist_id',
        'date',
        'income',
        'commission',
        'guide_payment',
    ];

    // Optional: Relationships for future use
    public function guide() {
        return $this->belongsTo(Guide::class);
    }

    public function tourist() {
        return $this->belongsTo(User::class, 'tourist_id');
    }

    public function booking() {
        return $this->belongsTo(Booking::class);
    }

    public function tour() {
        return $this->belongsTo(Tour::class);
    }
}
