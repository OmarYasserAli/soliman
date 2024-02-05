<?php

use App\Models\City;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_cities', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->string('slug')->nullable();
            $table->timestamps();
        });
        // $cities = ['الرياض', 'جدة', 'الدمام', 'مكة', 'الخبر'];
        // foreach($cities as $city){
        //     $new = new City;
        //     $new->name = $city;
        //     $new->save();
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selling_cities');
    }
}
