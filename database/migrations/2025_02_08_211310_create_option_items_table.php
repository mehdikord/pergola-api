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
        Schema::create('option_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('option_id');
            $table->string('item')->nullable();
            $table->string('subtitle')->nullable();
            $table->timestamps();
            $table->foreign('option_id')->references('id')->on('options')->cascadeOnDelete()->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('option_items');
    }
};
