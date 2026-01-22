<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    protected $fillable = [
        'branch_name',
        'location',
        'address',
        'phone',
        'email',
        'status',
    ];

    /**
     * Get the lab tests offered by this branch
     */
    public function labTests(): BelongsToMany
    {
        return $this->belongsToMany(LabTest::class, 'branch_lab_tests');
    }

    /**
     * Get test schedules at this branch
     */
    public function testSchedules(): HasMany
    {
        return $this->hasMany(TestSchedule::class);
    }

    /**
     * Scope for active branches
     */
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
