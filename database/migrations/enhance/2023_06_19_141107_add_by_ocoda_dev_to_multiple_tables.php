<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddByOcodaDevToMultipleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('by_ocoda_dev')->nullable();
        });
        Schema::table('managements', function (Blueprint $table) {
            $table->boolean('by_ocoda_dev')->nullable();
        });
        Schema::table('values', function (Blueprint $table) {
            $table->boolean('by_ocoda_dev')->nullable();
        });
        Schema::table('news', function (Blueprint $table) {
            $table->boolean('by_ocoda_dev')->nullable();
        });
        Schema::table('events', function (Blueprint $table) {
            $table->boolean('by_ocoda_dev')->nullable();
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->boolean('by_ocoda_dev')->nullable();
        });
        Schema::table('projects', function (Blueprint $table) {
            $table->boolean('by_ocoda_dev')->nullable();
        });
        Schema::table('logos', function (Blueprint $table) {
            $table->boolean('by_ocoda_dev')->nullable();
        });
        Schema::table('molhem', function (Blueprint $table) {
            $table->boolean('by_ocoda_dev')->nullable();
        });
        Schema::table('slider', function (Blueprint $table) {
            $table->boolean('by_ocoda_dev')->nullable();
        });
        Schema::table('selling_projects', function (Blueprint $table) {
            $table->boolean('by_ocoda_dev')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIfExists('by_ocoda_dev');
        });
        Schema::table('managements', function (Blueprint $table) {
            $table->dropIfExists('by_ocoda_dev');
        });
        Schema::table('values', function (Blueprint $table) {
            $table->dropIfExists('by_ocoda_dev');
        });
        Schema::table('news', function (Blueprint $table) {
            $table->dropIfExists('by_ocoda_dev');
        });
        Schema::table('events', function (Blueprint $table) {
            $table->dropIfExists('by_ocoda_dev');
        });
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn('by_ocoda_dev')->nullable();
        });
        Schema::table('logos', function (Blueprint $table) {
            $table->dropIfExists('by_ocoda_dev');
        });
        Schema::table('molhem', function (Blueprint $table) {
            $table->dropIfExists('by_ocoda_dev');
        });
        Schema::table('slider', function (Blueprint $table) {
            $table->dropIfExists('by_ocoda_dev');
        });
        Schema::table('selling_projects', function (Blueprint $table) {
            $table->dropColumn('by_ocoda_dev')->nullable();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->dropIfExists('by_ocoda_dev');
        });
    }
}
