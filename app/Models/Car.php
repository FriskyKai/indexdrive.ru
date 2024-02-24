<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'mark',
        'title',
        'car_number',
        'branch_id',
        'price',
    ];

    public function branch() {
        return $this->belongsTo(Branch::class);
    }

    public function bookingCars() {
        return $this->hasMany(BookingCar::class);
    }
}
