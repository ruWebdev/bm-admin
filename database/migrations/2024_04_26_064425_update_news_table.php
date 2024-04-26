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

        Schema::dropIfExists('news_images');
        Schema::dropIfExists('news');



        Schema::create('news', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('page_alias')->nullable();
            $table->string('title')->nullable();
            $table->string('short_description')->nullable();
            $table->text('long_description')->nullable();
            $table->string('main_photo')->nullable();
            $table->string('page_photo')->nullable();
            $table->integer('moderation_status')->default(0);
            $table->boolean('enable_page')->default(false);
            $table->foreignUuid('user_id')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->integer('page_views')->default(0);
            $table->timestamps();
        });

        Schema::create('news_images', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('file_name')->nullable();
            $table->string('full_path')->nullable();
            $table->foreignUuid('news_id')->references('id')->on('news')->onDelete('cascade');
            $table->timestamps();
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
