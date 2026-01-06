<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;

    protected $fillable = [
        'province',
        'city',
        'subdistrict',
        'street_address',
        'user_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
