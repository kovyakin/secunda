<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationPhones extends Model
{
    use HasFactory;

    protected $table = 'organization_phones';

    protected $fillable = [
        'organization_id',
        'phone_number'
    ];

    public function organization(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }
}
