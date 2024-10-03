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
        Schema::create('userExercises', function (Blueprint $table) {
            $table->id();
            $table->integer('attempts');
            $table->double('score');
            $table->dateTime('lastAttempted');
            $table->foreignId('userId')->constrained('users')->onDelete('cascade');
            $table->foreignId('exerciseId')->constrained('exercises')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userExercises');
    }
};
