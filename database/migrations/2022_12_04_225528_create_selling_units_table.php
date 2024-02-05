<?php

use App\Models\Unit;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingUnitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_units', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->default(0);
            $table->unsignedBigInteger('type_id')->default(0);
            $table->unsignedBigInteger('floor_id')->default(0);
            $table->text('name');
            $table->tinyInteger('rooms')->default(0);
            $table->float('space')->default(0);
            $table->float('space_acc')->default(0);
            $table->decimal('price', 10)->default(0);
            $table->text('gallery')->nullable();
            $table->text('accessories')->nullable();
            $table->text('specifications')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
        // for($i=1;$i<=5;$i++){
        //         $new = new Unit;
        //         $new->project_id = $i;
        //         $new->floor_id = $i;
        //         $new->type_id = $i;
        //         $new->rooms = $i;
        //         $new->name = 'Unit ' . $i;
        //         $new->save();
        // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('selling_units');
    }
}
