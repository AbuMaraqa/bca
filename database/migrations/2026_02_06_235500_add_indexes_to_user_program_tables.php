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
        Schema::table('user_program_meal_supplement', function (Blueprint $table) {
            $table->index('program_meal_id');
            $table->index('supplement_id');
            // Adding composite index for the join/sum query
            // where program_id = X
            // join program_meal where day = Y
            // So we need indexing on program_meal(program_id, day) too
        });

        Schema::table('user_program_meal', function (Blueprint $table) {
            $table->index(['program_id', 'day']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_program_meal_supplement', function (Blueprint $table) {
            $table->dropIndex(['program_meal_id']);
            $table->dropIndex(['supplement_id']);
        });

        Schema::table('user_program_meal', function (Blueprint $table) {
            $table->dropIndex(['program_id', 'day']);
        });
    }
};
