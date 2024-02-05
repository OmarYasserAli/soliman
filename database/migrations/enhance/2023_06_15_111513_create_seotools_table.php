<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeotoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('seotools', function (Blueprint $table) {
            $table->id();

            // Meta title and description
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();

            // Open Graph Columns
            $table->string('og_type')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_url')->nullable();
            $table->text('og_image')->nullable();
            $table->string('og_description')->nullable();

            // Twitter Card Columns
            $table->text('twitter_card')->nullable();
            $table->string('twitter_title')->nullable();
            $table->string('twitter_site')->nullable();
            $table->text('twitter_description')->nullable();
            $table->text('twitter_image')->nullable();
            $table->text('twitter_image_alt')->nullable();

            // SEO for pages
            $table->enum('page_name', ['home', 'about_us', 'booking_system', 'news', 'events', 'files', 'investors_relation', 'molhem', 'contact'])->nullable()->unique();

            // Polymorphic
            $table->integer('seoable_id')->nullable();
            $table->string('seoable_type')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('seotools');
    }
}
