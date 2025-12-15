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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->timestamps('created_at');
            $table->text('content');
            $table->string('title');
            $table->string('image_url');
            $table->foreignId('user_id')
          ->nullable()
          ->constrained('users', 'id')
          ->nullOnDelete();
          $table->string('name'); 
          $table->foreignId('category_id')->constrained('categories', 'id')->onDelete('cascade');
        });
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
