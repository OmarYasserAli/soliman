<?php

namespace App\Http\Controllers\Enhance\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Sitemap\SitemapGenerator;

class SitemapController extends Controller
{
    /**
     * Generate sitemap file
     */
    public function __invoke()
    {
        SitemapGenerator::create(env('APP_URL'))->writeToFile(public_path('sitemap.xml'));

        return redirect()->back()->with('success','Sitemap Generated Successfully');
    }
}
