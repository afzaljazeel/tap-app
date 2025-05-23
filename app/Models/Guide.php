<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location',
        'profile_picture',
        'experience',
        'certification',
        'specialties'
    ];

    // Define relationship with User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    //Bookings
    public function bookings()
{
    return $this->hasMany(Booking::class);
}

public function tours()
{
    return $this->hasMany(Tour::class);
}
}
