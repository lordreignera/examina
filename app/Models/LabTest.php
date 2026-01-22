<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LabTest extends Model
{
    protected $fillable = [
        'test_name',
        'description',
        'status',
    ];

    public function testCategories(): HasMany
    {
        return $this->hasMany(TestCategory::class, 'lab_test_id');
    }

    /**
     * Get branches that offer this lab test
     */
    public function branches(): BelongsToMany
    {
        return $this->belongsToMany(Branch::class, 'branch_lab_tests');
    }

    public function scheduleItems(): HasMany
    {
        return $this->hasManyThrough(TestScheduleItem::class, TestCategory::class, 'lab_test_id', 'test_category_id');
    }
}
