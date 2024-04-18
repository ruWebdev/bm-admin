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
        Schema::create('composer_photos', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('file_name')->nullable();
            $table->string('full_path')->nullable();
            $table->foreignUuid('composer_id')->references('id')->on('composers')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('composer_photos');
    }
};
