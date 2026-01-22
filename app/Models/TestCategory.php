<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TestCategory extends Model
{
    protected $fillable = [
        'lab_test_id',
        'parent_id',
        'category_name',
        'test_code',
        'level',
        'specimen_id',
        'price',
        'description',
        'duration',
        'when_done',
        'status',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'level' => 'integer',
    ];

    /**
     * Boot method to auto-generate test codes
     */
    protected static function boot()
    {
        parent::boot();

        // Use 'saving' event instead of 'creating' to ensure all attributes are set
        static::saving(function ($testCategory) {
            // Auto-generate test code if not provided and it's a priced test
            if (empty($testCategory->test_code) && $testCategory->price > 0 && $testCategory->lab_test_id) {
                $testCategory->test_code = static::generateTestCode($testCategory);
            }
        });
    }

    /**
     * Generate unique test code based on lab test and sequence
     * Format: PREFIX-LLSSSS (LL = level, SSSS = sequence)
     * Example: ALL-30001 (Allergy, Level 3, Sequence 0001)
     */
    public static function generateTestCode($testCategory): string
    {
        // Get lab test to create prefix
        $labTest = LabTest::find($testCategory->lab_test_id);
        
        if (!$labTest) {
            return 'UNK-00001';
        }
        
        // Create prefix from lab test name (first 3 letters, uppercase)
        $testName = str_replace(' ', '', $labTest->test_name);
        $prefix = strtoupper(substr($testName, 0, 3));
        
        // Get count of existing test codes for this lab test
        $existingCount = static::where('lab_test_id', $testCategory->lab_test_id)
            ->whereNotNull('test_code')
            ->count();
        
        $sequence = $existingCount + 1;
        
        // Format: PREFIX-LLSSSS (LL = level, SSSS = 4-digit sequence)
        // Example: ALL-30001, HIV-10001, BLO-10002
        return sprintf('%s-%d%04d', $prefix, $testCategory->level ?? 1, $sequence);
    }

    public function labTest(): BelongsTo
    {
        return $this->belongsTo(LabTest::class, 'lab_test_id');
    }

    public function specimenType(): BelongsTo
    {
        return $this->belongsTo(SpecimenType::class, 'specimen_id');
    }

    /**
     * Get the parent category
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(TestCategory::class, 'parent_id');
    }

    /**
     * Get child categories
     */
    public function children(): HasMany
    {
        return $this->hasMany(TestCategory::class, 'parent_id');
    }

    /**
     * Get all descendants recursively
     */
    public function descendants(): HasMany
    {
        return $this->children()->with('descendants');
    }

    /**
     * Check if this is a parent category (has children)
     */
    public function isParent(): bool
    {
        return $this->children()->exists();
    }

    /**
     * Check if this is a leaf category (no children)
     */
    public function isLeaf(): bool
    {
        return !$this->isParent();
    }

    /**
     * Get only root categories (level 1, no parent)
     */
    public function scopeRoots($query)
    {
        return $query->whereNull('parent_id')->where('level', 1);
    }

    /**
     * Get categories by level
     */
    public function scopeLevel($query, int $level)
    {
        return $query->where('level', $level);
    }

    public function scheduleItems(): HasMany
    {
        return $this->hasMany(TestScheduleItem::class, 'test_category_id');
    }

    // Alias for backward compatibility
    public function specimen(): BelongsTo
    {
        return $this->specimenType();
    }
}
