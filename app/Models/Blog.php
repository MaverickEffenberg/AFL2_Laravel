<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'name',
        'content',
        'image_url',
        'category_id',
        'user_id',
        'published_at',
    ];
    //testt

    /**
     * Provide defaults for attributes required by DB (e.g. non-null `image_url`).
     */
    protected $attributes = [
        'image_url' => '',
        'name' => '',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
