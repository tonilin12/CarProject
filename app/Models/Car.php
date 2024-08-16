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

    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'img'=>'string',
        'daily_price' => 'integer',
    ];

    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

}
