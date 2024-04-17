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
            $table->string('page_alias');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('first_name_short');
            $table->string('birth_date');
            $table->string('death_date');
            $table->string('main_photo');
            $table->string('short_description');
            $table->text('long_description');
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
