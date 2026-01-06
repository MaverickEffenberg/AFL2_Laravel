<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    // The existing promotions table does not have created_at/updated_at columns
    // so disable automatic timestamps to avoid SQL errors.
    public $timestamps = false;

    protected $fillable = [
        'plant_id',
        'discount_percentage',
        'start_at',
        'end_at',
        'title',
        'description',
    ];

    protected $casts = [
        'start_at' => 'datetime',
        'end_at' => 'datetime',
        'discount_percentage' => 'float',
    ];

    /**
     * Promotion belongs to a Plant
     */
    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }

    /**
     * Scope: only active promotions
     */
    public function scopeActive($query)
    {
        $now = now();

        return $query
            ->where('start_at', '<=', $now)
            ->where('end_at', '>=', $now);
    }

    /**
     * Check if promotion is currently active
     */
    public function isActive(): bool
    {
        $now = now();

        return $this->start_at <= $now && $this->end_at >= $now;
    }

    /**
     * Calculate discounted price
     */
    public function discountedPrice(float|int $price): int
    {
        return (int) round(
            $price * (1 - ($this->discount_percentage / 100))
        );
    }
}
