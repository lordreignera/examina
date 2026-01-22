<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $table = 'test_schedules';
    
    protected $fillable = [
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

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'test_schedule_id');
    }
}
