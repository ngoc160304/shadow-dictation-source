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
        Schema::create('audio_urls', function (Blueprint $table) {
            $table->id();
            $table->string('url');
            $table->foreignId('exerciseId')->constrained('exercises')->onDelete('cascade');
            $table->string('textEng');
            $table->text('textVN');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audio_urls');
    }
};
