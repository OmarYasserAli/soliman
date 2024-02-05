<?php

use App\Models\Floor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingFloorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_floors', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->timestamps();
        });
        // $floors = ['الأرضى','الأول','الثانى','الثالث','الرابع','الخامس','السادس'];
        // foreach($floors as $floor){
        //     $new = new Floor;
        //     $new->name = $floor;
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
        Schema::dropIfExists('selling_floors');
    }
}
