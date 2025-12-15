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
        Schema::create('sales_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_id')->constrained('sales', 'id')->onDelete('cascade');
            $table->foreignId('plant_id')->constrained('plants', 'id')->nullOnDelete();
            $table->integer('total_price');
            $table->integer('amount');
            $table->string('plant_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_items');
    }
};
