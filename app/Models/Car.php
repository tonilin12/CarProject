<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo; // Import BelongsTo


class Car extends Model
{
    use HasFactory;

    protected $fillable = [
          'reg_num',
          'brand',
          'booking_startdate',
          'booking_deadline',
          'user_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
