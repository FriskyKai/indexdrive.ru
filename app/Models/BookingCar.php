<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingCar extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'car_id',
        'booking_id',
    ];

    public function booking() {
        return $this->belongsTo(Booking::class);
    }

    public function car() {
        return $this->belongsTo(Car::class);
    }
}
