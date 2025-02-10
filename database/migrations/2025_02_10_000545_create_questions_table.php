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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('from_color_id');
            $table->unsignedBigInteger('to_color_id');
            $table->text('items')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->foreign('from_color_id')->references('id')->on('colors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('to_color_id')->references('id')->on('colors')->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
