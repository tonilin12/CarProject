<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    // Define the table associated with the model (optional if it follows Laravel's naming conventions)
    protected $table = 'bookings';

    // Define fillable fields for mass assignment
    protected $fillable = [
        'start_date',
        'deadline',
        'user_id',
        'car_id'
    ];

    // Define the attributes that should be cast to native types
    protected $casts = [
        'start_date' => 'datetime',
        'deadline' => 'datetime',
    ];

    // Define relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
