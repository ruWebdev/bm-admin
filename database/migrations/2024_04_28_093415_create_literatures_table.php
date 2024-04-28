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
        Schema::create('literature', function (Blueprint $table) {
            $table->uuid('id');
            $table->primary('id');
            $table->string('page_alias')->nullable();
            $table->string('title');
            $table->string('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->string('main_photo')->nullable();
            $table->string('page_photo')->nullable();
            $table->integer('moderation_status')->default(0);
            $table->boolean('enable_page')->default(false);
            $table->string('external_link')->nullable();
            $table->foreignUuid('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->integer('page_views')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('literature');
    }
};
