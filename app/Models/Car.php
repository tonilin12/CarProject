<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import BelongsTo


class Car extends Model
{
    use HasFactory;

    protected $fillable = [
          'reg_num',
          'booking_startdate',
          'booking_deadline',
          'img',
          'user_id',
          'is_booked',
    ];

    protected $casts = [
        'booking_startdate' => 'datetime',
        'booking_deadline' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'img'=>'string'
    ];

    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

}
