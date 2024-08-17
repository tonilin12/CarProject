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
          'img',
          'daily_price',
          'user_id',
          'is_active',


    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'img'=>'string',
        'daily_price' => 'integer',
        'is_active'=>'boolean',
    ];

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($car) {
            // Check if the car's status has been changed to inactive
            if ($car->isDirty('is_active') && !$car->is_active) {
                // Delete related bookings
                $car->bookings()->delete();
            }
        });
    }

}
