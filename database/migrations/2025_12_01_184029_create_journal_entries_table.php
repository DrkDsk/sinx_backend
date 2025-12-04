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
        Schema::create('journal_entries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade');

            $table->string('color_type')->nullable();
            $table->text('content');
            $table->string('image_url')->nullable();
            $table->boolean('is_pinned')->default(false);
            $table->string('mood_emoji')->nullable();
            $table->float('position_x')->default(0);
            $table->float('position_y')->default(0);
            $table->float('rotation')->default(0);
            $table->json('tags')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journal_entries');
    }
};
