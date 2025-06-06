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
        Schema::table('question_answers', function (Blueprint $table) {
            $table->text('options')->nullable()->after('answer');
            $table->text('colors')->nullable()->after('options');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('question_answers', function (Blueprint $table) {
            //
        });
    }
};
