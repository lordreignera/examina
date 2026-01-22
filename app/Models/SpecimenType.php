<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SpecimenType extends Model
{
    protected $fillable = [
        'specimen_name',
        'description',
    ];

    public function testCategories(): HasMany
    {
        return $this->hasMany(TestCategory::class, 'specimen_id');
    }
}
