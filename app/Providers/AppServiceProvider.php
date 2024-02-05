<?php

namespace App\Providers;

use App\Models\Set;
use App\Models\Page;
use App\Models\Product;
use App\Models\Project;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function() {
            return base_path() . '/public_html';
        });
        View::composer('*', function($view){
            // $lang = (string)session()->get('locale') == 'en' ? 'en' : 'ar';
            $lang = LaravelLocalization::getCurrentLocale();
            $view->with('lang', $lang);
            $view->with('style', $lang == 'en' ? 'enmain.css' : 'main.css');
            // Cache::forget('set');
            if(!Cache::has('set')){
                $nset = function(){
                    $set = Set::all();
                    $nset = [];
                    foreach ($set as $item) {
                        if(in_array($item->key,
                        ['homebg', 'about_image', 'media_image', 'investor_image', 'contact_image','head',
                        'investor_image','media_image','phone', 'email', 'twitter','instagram','linkedin','youtube','profile', 'map','whatsapp',
                        'home_phone', 'home_whatsapp', 'project_phone', 'project_whatsapp', 'product_phone', 'product_whatsapp', 'favor_email','campain_whatsapp', 'campain_phone', 'campain_map', 'campain_info', 'campain_title', 'selling_image'
                        ,'bluedar_image',  'bluedar_logo','bluedar_about_image' , 'bluedar_gallery','bluedar_map_image' , 'bluedar_interesting_image','bluedar_gallery_image', 'footer_script', 'robots_file'])){
                            $nset[$item->key] = $item->value;
                        }elseif(in_array($item->key, ['privecy_page', 'terms_page'])){
                            if($item->value){
                                $page = Page::find((int)$item->value);
                                $nset[$item->key] = !empty($page) ? route('pageBySlug', (string)$page->slug) : 0;
                            }
                        }else{
                            $nset[$item->key] = json_decode($item->value);
                        }
                    }
                    return (object)$nset;
                };
                Cache::rememberForever('set', $nset);
            }
            $set= Cache::get('set');
            if(Route::is('home')){
                $set->hphone = @$set->home_phone;
                $set->hwhatsapp = @$set->home_whatsapp;
            }elseif(Route::is('product')){
                $set->hphone = @$set->product_phone;
                $set->hwhatsapp = @$set->product_whatsapp;
            }elseif(Route::is('project')){
                $set->hphone = @$set->project_phone;
                $set->hwhatsapp = @$set->project_whatsapp;
            }
            $view->with('set', $set);
        });
        View::composer('theme.*', function($view){
            if(request()->has('fresh')){
                Cache::forget('projects');
                Cache::forget('products');
            }
            //Projects
            $projects = Cache::rememberForever('projects', function () {
                return Project::select('title', 'slug', 'slug_ar')->take(3)->get();
            });
            $view->with('projects', Cache::get('projects'));
            //Products
            $products = Cache::rememberForever('products', function () {
                return Product::select('title', 'slug', 'slug_ar')->get();
            });
            $view->with('products', Cache::get('products'));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->environment('production')) {
            \URL::forceScheme('https');
        }

        /**
         * Load migration files from any subdirectories also.
         */
        $migrationsPath = database_path('migrations');
        $directories    = glob($migrationsPath.'/*', GLOB_ONLYDIR);
        $paths          = array_merge([$migrationsPath], $directories);

        $this->loadMigrationsFrom($paths);
    }
}
