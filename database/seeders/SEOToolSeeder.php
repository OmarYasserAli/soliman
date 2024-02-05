<?php

namespace Database\Seeders;

use App\Models\Enhance\SEOTool;
use Illuminate\Database\Seeder;

class SEOToolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pages = ['home', 'about_us', 'booking_system', 'news', 'events', 'files', 'investors_relation', 'molhem', 'contact'];

        foreach($pages as $page) {
            SEOTool::create(['page_name' => $page]);
        }
    }
}
