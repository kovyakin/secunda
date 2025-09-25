<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    use HasFactory;

    protected $table = 'activities';

    protected $fillable = [
        'name',
        'parent_id'
    ];

    public function organization(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Organization::class, 'activity_organization', 'activity_id', 'organization_id');
    }
}
