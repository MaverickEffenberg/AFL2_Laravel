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
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plant_id')->constrained('plants', 'id')->onDelete('cascade');
            $table->decimal('discount_percentage');
            $table->timestampTz('end_at');
            $table->timestampTz('start_at');
            $table->text('description');
            $table->text('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};
