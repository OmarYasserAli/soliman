<?php

use App\Models\Area;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingAreasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_areas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id');
            $table->text('name');
            $table->string('slug')->nullable();
            $table->timestamps();
        });
        // $areas = [
        //     1 => ['حي الرياض ١', 'حي الرياض ٢', 'حي الرياض ٣', 'حي الرياض ٤'],
        //     2 => ['حي جدة ١', 'حي جدة ٢', 'حي جدة ٣', 'حي جدة ٤'],
        //     3 => ['حي الدمام ١', 'حي الدمام ٢', 'حي الدمام ٣', 'حي الدمام ٤'],
        //     4 => ['حي مكة ١', 'حي مكة ٢', 'حي مكة ٣', 'حي مكة ٤'],
        //     5 => ['حي الخبر ١', 'حي الخبر ٢', 'حي الخبر ٣', 'حي الخبر ٤'],
        // ];
        // foreach($areas as $id => $area){
        //     foreach($area as $ar){
        //         $new = new Area;
        //         $new->city_id = $id;
        //         $new->name = $ar;
        //         $new->save();
        //     }
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selling_areas');
    }
}
