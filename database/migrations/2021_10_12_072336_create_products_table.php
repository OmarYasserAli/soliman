<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->mediumText('name');
            $table->mediumText('title');
            $table->string('slug')->unique();
            $table->string('image')->nullable();
            $table->string('logo')->nullable();
            $table->mediumText('map')->nullable();
            $table->mediumText('breif')->nullable();
            $table->mediumText('gallery')->nullable();
            $table->mediumText('sizes')->nullable();
            $table->string('profile')->nullable();
            $table->integer('owner')->default(0);
            $table->integer('developer')->default(0);
            $table->integer('contractor')->default(0);
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
        Schema::dropIfExists('products');
    }
}
