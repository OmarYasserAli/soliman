<?php

use App\Models\SProject;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('original_id')->default(0);
            $table->string('name');
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('city_id')->default(0);
            $table->unsignedBigInteger('area_id')->default(0);
            $table->string('logo')->nullable();
            $table->string('cover')->nullable();
            $table->string('buildings_count')->nullable();
            $table->string('floors_max')->nullable();
            $table->string('url360')->nullable();
            $table->string('profile')->nullable();
            $table->string('location')->nullable();
            $table->text('gallery')->nullable();
            $table->text('igallery')->nullable();
            $table->tinyInteger('type')->default(0);
            $table->tinyInteger('status')->default(0);
            $table->timestamps();
        });
        // $projects = ['Apartment porject', 'Building project', 'Villa Project'];
        // $projectsTypes = [0, 1, 2];
        // foreach($projects as $k=>$project){
        //     $new = new SProject;
        //     $new->name = $project;
        //     $new->slug = sluger($project);
        //     $new->type = $projectsTypes[$k];
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
        Schema::dropIfExists('selling_projects');
    }
}
