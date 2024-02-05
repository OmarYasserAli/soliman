<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMolhemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('molhem', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('cat')->nullable();
            $table->mediumText('title');
            $table->mediumText('breif')->nullable();
            $table->string('image')->nullable();
            $table->longText('content')->nullable();
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
        Schema::dropIfExists('molhem');
    }
}
