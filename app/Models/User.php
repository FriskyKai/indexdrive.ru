<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $fillable = [
        'first_name',
        'last_name',
        'patronymic',
        'phone',
        'birth_date',
        'passport_series',
        'passport_number',
        'password',
    ];

    protected $hidden = [
        'password',
        'api_token',
    ];

    public $timestamps = false;

    public function bookings() {
        return $this->hasMany(Booking::class);
    }
}
