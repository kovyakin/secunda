<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    protected $table = 'organizations';

    protected $fillable = [
        'name',
        'building_id'
    ];

    public function building(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Buildings::class,'building_id');
    }

    public function phones(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrganizationPhones::class);
    }

    public function activities(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Activities::class, 'activity_organization', 'organization_id', 'activity_id');
    }
}
