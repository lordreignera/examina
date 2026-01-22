<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TestScheduleItem extends Model
{
    protected $table = 'test_schedule_items';
    
    protected $fillable = [
        'test_schedule_id',
        'test_category_id',
        'test_name',
        'price',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function testSchedule(): BelongsTo
    {
        return $this->belongsTo(TestSchedule::class, 'test_schedule_id');
    }

    public function testCategory(): BelongsTo
    {
        return $this->belongsTo(TestCategory::class, 'test_category_id');
    }
}
