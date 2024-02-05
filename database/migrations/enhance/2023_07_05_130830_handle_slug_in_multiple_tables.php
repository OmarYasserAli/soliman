<?php

use App\Models\News;
use App\Models\Page;
use App\Models\Event;
use App\Models\Molhem;
use App\Models\Campain;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class HandleSlugInMultipleTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->handleTableSlug('products', 'product', 'name');
        $this->handleTableSlug('events', 'event', 'title');
        $this->handleTableSlug('news', 'news', 'title');
        $this->handleTableSlug('pages', 'page', 'title');
        $this->handleTableSlug('projects', 'project', 'name');
        $this->handleTableSlug('molhem', 'molhem', 'title');

        Schema::table('campains', function (Blueprint $table) {
            $table->text('slug_ar')->nullable();
        });

        $campains = Campain::all();

        foreach($campains as $campain) {
            $campain->slug_ar = sluger($campain->title);
            $campain->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropIfExists('slug_ar');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropIfExists('slug_ar');
        });

        Schema::table('news', function (Blueprint $table) {
            $table->dropIfExists('slug_ar');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropIfExists('slug_ar');
        });

        Schema::table('projects', function (Blueprint $table) {
            $table->dropIfExists('slug_ar');
        });

        Schema::table('molhem', function (Blueprint $table) {
            $table->dropIfExists('slug_ar');
        });
    }

    /**
     * @param string $tableName
     * @param string $modelName
     * @param string $columnName
     */
    private function handleTableSlug(string $tableName, string $modelName, string $columnName)
    {
        Schema::table($tableName, function (Blueprint $table) {
            $table->string('slug_ar')->nullable()->unique();
        });

        $this->handleArSlug($modelName, $columnName);
    }

    /**
     * @param string $modelName
     * @param string $column
     */
    private function handleArSlug(string $modelName, string $column)
    {
        switch($modelName){
            case 'product':
                $records = Product::all();
                break;

            case 'event':
                $records = Event::all();
                break;

            case 'news':
                $records = News::all();
                break;

            case 'page':
                $records = Page::all();
                break;

            case 'project':
                $records = Project::all();
                break;

            case 'molhem':
                $records = Molhem::all();
                break;
        }

        foreach($records as $record) {
            $record->slug_ar = sluger($record->$column->ar);
            $record->save();
        }
    }
}
