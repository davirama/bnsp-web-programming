<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $fillable = [
        'province_id',
        'province',
    ];

    /**
     * Get the cities associated with the province.
     */
    public function cities()
    {
        return $this->hasMany(City::class, 'province_id', 'province_id');
    }
}
