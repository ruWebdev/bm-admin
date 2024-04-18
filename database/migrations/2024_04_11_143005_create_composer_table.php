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
        Schema::create('composers', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('page_alias')->nullable();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('first_name_short')->nullable();
            $table->string('last_name_en')->nullable();
            $table->string('first_name_en')->nullable();
            $table->string('first_name_short_en')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('death_date')->nullable();
            $table->string('main_photo')->nullable();
            $table->string('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->boolean('enabled')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('composer');
    }
};
