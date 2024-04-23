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
        Schema::table('musical_instruments', function (Blueprint $table) {
            $table->string('title_rod');
        });

        Schema::table('composers', function (Blueprint $table) {
            $table->string('last_name_rod');
            $table->string('first_name_rod');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
