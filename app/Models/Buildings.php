<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buildings extends Model
{
    use HasFactory;

    protected $table = 'buildings';
    protected $fillable = [
        'country',
        'city',
        'street',
        'house',
        'office',
        'lat',
        'lng'
    ];

    public function organization(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Organization::class, 'building_id');
    }
}
