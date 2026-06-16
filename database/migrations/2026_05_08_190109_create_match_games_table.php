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
        Schema::create('match_games', function (Blueprint $table) {
            $table->id();

            $table->foreignId('home_team_id')->constrained('teams')->onDelete('cascade');
            $table->foreignId('away_team_id')->constrained('teams')->onDelete('cascade');

            $table->integer('home_score')->nullable();
            $table->integer('away_score')->nullable();

            $table->text('home_scorers')->nullable();
            $table->text('away_scorers')->nullable();

            $table->string('location')->nullable();
            $table->dateTime('match_time')->nullable();

            $table->boolean('played')->default(false);

            $table->integer('match_minutes')->default(60);

            $table->integer('break_minutes')->default(10);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('match_games');
    }
};
