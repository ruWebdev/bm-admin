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
        Schema::create('musical_instrument_photos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('file_name')->nullable();
            $table->string('full_path')->nullable();
            $table->foreignUuid('musical_instrument_id')->references('id')->on('musical_instruments')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('musical_instrument_photos');
    }
};
