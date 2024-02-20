<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingCar extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',
        'booking_id',
    ];
}
