<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('test_schedule_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_schedule_id')->constrained('test_schedules')->onDelete('cascade');
            $table->foreignId('test_category_id')->constrained('test_categories')->onDelete('cascade');
            $table->string('test_name', 200);
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_schedule_items');
    }
};
