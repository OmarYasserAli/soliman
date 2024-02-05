<?php

use App\Models\Type;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_types', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id')->default(0);
            $table->text('name');
            $table->timestamps();
        });
        // $types = ['A','B','C','D', 'E'];
        // for($i=1;$i<=5;$i++){
        //     foreach($types as $type){
        //         $new = new Type;
        //         $new->project_id = $i;
        //         $new->name = $type;
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
        Schema::dropIfExists('selling_types');
    }
}
