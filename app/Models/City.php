<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $fillable = [
        'city_id',
        'province_id',
        'province',
        'type',
        'city_name',
        'postal_code',
    ];

    /**
     * Get the province associated with the city.
     */
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'province_id');
    }
}
