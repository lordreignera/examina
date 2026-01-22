<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestSchedule extends Model
{
    protected $table = 'test_schedules';
    
    protected $fillable = [
        'branch_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'schedule_date',
        'total_amount',
        'schedule_status',
    ];

    protected $casts = [
        'total_amount' => 'decimal:2',
        'schedule_date' => 'date',
    ];

    /**
     * Get the branch where test is scheduled
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(TestScheduleItem::class, 'test_schedule_id');
    }
}
