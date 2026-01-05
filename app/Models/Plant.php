<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'price',
        'stock',
        'image_url'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Plant has many promotions
     */
    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    /**
     * Get the currently active promotion for this plant (highest discount first)
     */
    public function currentPromotion()
    {
        return $this->promotions()->active()->orderByDesc('discount_percentage')->first();
    }

    /**
     * Accessor for current price after applying active promotion
     */
    public function getCurrentPriceAttribute()
    {
        $promo = $this->currentPromotion();

        if ($promo) {
            return $promo->discountedPrice($this->price);
        }

        return $this->price;
    }
}