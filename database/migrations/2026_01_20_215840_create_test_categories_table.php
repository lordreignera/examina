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
        Schema::create('test_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lab_test_id')->constrained('lab_tests')->onDelete('cascade');
            $table->foreignId('parent_id')->nullable()->constrained('test_categories')->onDelete('cascade');
            $table->string('category_name', 200);
            $table->string('test_code', 50)->nullable()->comment('Code like I0366_3 for specific tests');
            $table->integer('level')->default(1)->comment('Hierarchy level: 1=main, 2=sub, 3=sub-sub, etc');
            $table->foreignId('specimen_id')->nullable()->constrained('specimen_types')->onDelete('cascade');
            $table->decimal('price', 10, 2)->default(0);
            $table->text('description')->nullable();
            $table->string('duration')->nullable()->comment('How long the test takes');
            $table->string('when_done')->nullable()->comment('When the test is performed');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('test_categories');
    }
};
