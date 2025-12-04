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
        Schema::create('streak_adjustments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('streak_id')
                ->constrained('streaks')
                ->onDelete('cascade');

            $table->date('date')->nullable();
            $table->integer('delta');
            $table->text('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('streak_adjustments');
    }
};
