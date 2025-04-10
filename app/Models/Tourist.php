<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',         // Foreign Key from users table
        'nationality',     // Country of the tourist
        'phone',           // Contact number
        'extra_notes',     // Any additional info
    ];

    /**
     * Get the user associated with the tourist.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

//bookings
    public function bookings()
{
    return $this->hasMany(Booking::class, 'tourist_id');
}

}
