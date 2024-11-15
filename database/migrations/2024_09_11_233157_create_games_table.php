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
        Schema::create('games', function (Blueprint $table) {
            
            $table->id();
            $table->string('gameId');

            $table->foreignId('user_id')->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->string('type', 8);

            $table->string('words', 255);

            $table->string('daily_game', 255)->charset('utf8mb4')
                ->collation('utf8mb4_unicode_ci');

            $table->string('attempts')->nullable()->default(null);

            $table->string('chart')->charset('utf8mb4')
                ->collation('utf8mb4_unicode_ci');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};
