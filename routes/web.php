<?php

use App\Models\Logo;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use App\Services\SEO\SEOToolsService;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\FilesController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\LogosController;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\EventsController;
use App\Http\Controllers\Admin\MolhemController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ValuesController;
use App\Http\Controllers\Selling\MainController;
use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\Admin\BranchesController;
use App\Http\Controllers\Admin\CampainsController;
use App\Http\Controllers\Admin\FormsController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ProjectsController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\CompaniesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\InvestorsController;
use App\Http\Controllers\Admin\NewsletterController;
use App\Http\Controllers\Admin\ManagementsController;
use App\Http\Controllers\Enhance\Admin\SitemapController;
use App\Http\Controllers\Admin\InvestmentsGroupController;
use App\Http\Controllers\Enhance\Admin\SeoPagesController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('locale/{locale?}', [HomeController::class, 'changeLocale'])->name('lang');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect']
], function()
{
    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('about-us', [HomeController::class, 'about'])->name('about');
    Route::get('campains/sakenah-residence', [HomeController::class, 'sakenahResidence'])->name('sresidence');
    Route::get('campains/alsoliman-contact', [HomeController::class, 'alsolimanContact'])->name('campain-contact');
    Route::get('campains/alsoliman-contact2', [HomeController::class, 'alsolimanContact2'])->name('campain-contact2');
    Route::get('campains/alsoliman-contact3', [HomeController::class, 'alsolimanContact3'])->name('campain-contact3');
    Route::get('campains/blue-dar', [HomeController::class, 'alsolimanContact4'])->name('campain-contact4');
    Route::get('campains/{title}', [HomeController::class, 'getCampain'])->name('campain');
    Route::get('forms/{title}', [HomeController::class, 'getForm'])->name('forms');
    Route::post('forms', [HomeController::class, 'saveFormData'])->name('save-form-data');
    Route::get('contact', [HomeController::class, 'contact'])->name('contact');
    Route::post('contact', [HomeController::class, 'contactPost'])->name('contact.post');
    Route::get('events', [HomeController::class, 'events'])->name('events');
    Route::get('events/{slug}', [HomeController::class, 'event'])->name('event');
    Route::get('files', [HomeController::class, 'files'])->name('files');
    Route::get('investors', [HomeController::class, 'investors'])->name('investors');
    Route::get('news', [HomeController::class, 'news'])->name('news');
    Route::get('news/{slug}', [HomeController::class, 'newsBySlug'])->name('newsBySlug');
    Route::get('page/{slug}', [HomeController::class, 'pageBySlug'])->name('pageBySlug');
    Route::get('product/{slug}', [HomeController::class, 'product'])->name('product');
    Route::get('project/blue-dar-project', [HomeController::class, 'projectBlueDar'])->name('project.bluedar');

    // For arabic slug
    Route::get('project/مشروع-بلودار', [HomeController::class, 'projectBlueDarAr'])->name('project.bluedar.ar');

    Route::get('project/{slug}', [HomeController::class, 'project'])->name('project');
    Route::get('molhem', [HomeController::class, 'molhem'])->name('molhem');
    Route::get('molhem/{slug}', [HomeController::class, 'smolhem'])->name('smolhem');
    Route::post('newsletter', [HomeController::class, 'newsletter'])->name('newsletter.post');
    Route::post('register-project', [HomeController::class, 'registerProject'])->name('register.project');
    Route::post('bluedar-interest', [HomeController::class, 'blueDarPost'])->name('project.bluedar.post')->middleware('localization');

    Route::get('/test', function () {
        dd(LaravelLocalization::getCurrentLocale());
    });
});


Route::get('xy', function () {
    $request = (object)[];
    $request->title = 'title here';
    $request->name = 'ahmed me';
    $request->email = 'ahmed@ahmed.a';
    $request->phone = '12345';
    dd($request, submit_lead($request));
});

Route::prefix('admin')->middleware(['dlang'])->group(function () {

    Route::middleware('guest')->group(function () {
        Route::get('login', [LoginController::class, 'loginForm'])->name('admin.login.form');
        Route::post('login', [LoginController::class, 'login'])->name('admin.login');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
        Route::get('/', [DashboardController::class, 'home'])->name('admin.home');
        Route::get('bluedar-interest', [DashboardController::class, 'bluedarInterestList'])->name('admin.bluedar');

        Route::get('settings', [DashboardController::class, 'settingsFrom'])->name('admin.settings.form');
        Route::post('settings', [DashboardController::class, 'settings'])->name('admin.settings');

        Route::get('settings/contact', [DashboardController::class, 'contactFrom'])->name('admin.contact.form');

        Route::get('settings/about', [DashboardController::class, 'aboutFrom'])->name('admin.about.form');

        Route::get('settings/investor', [DashboardController::class, 'investorFrom'])->name('admin.investor.form');

        Route::get('settings/media', [DashboardController::class, 'mediaFrom'])->name('admin.media.form');
        Route::get('settings/pages', [DashboardController::class, 'pagesFrom'])->name('admin.pages.form');
        Route::get('settings/numbers', [DashboardController::class, 'numbersFrom'])->name('admin.numbers.form');
        Route::get('settings/campain', [DashboardController::class, 'campainsFrom'])->name('admin.settings.campain');
        Route::get('settings/bluedar-page', [DashboardController::class, 'blueDarForm'])->name('admin.settings.bludarform');


        Route::resource('users', UsersController::class);
        Route::resource('campains', CampainsController::class);
        Route::get('forms/data', [FormsController::class,'data'])->name('admin.forms.data');
        Route::resource('forms', FormsController::class);
        Route::resource('news', NewsController::class);
        Route::resource('pages', PagesController::class);
        Route::resource('services', ServicesController::class);
        Route::resource('newsletters', NewsletterController::class);
        Route::resource('events', EventsController::class);
        Route::resource('files', FilesController::class);
        Route::resource('values', ValuesController::class);
        Route::resource('investors', InvestorsController::class);
        Route::resource('managements', ManagementsController::class);
        Route::resource('projects', ProjectsController::class);
        Route::resource('products', ProductsController::class);
        Route::resource('companies', CompaniesController::class);
        Route::resource('logos', LogosController::class);
        Route::resource('slider', SliderController::class);
        Route::resource('igroups', InvestmentsGroupController::class);
        Route::resource('molhem', MolhemController::class);

        // SEO Pages Routes
        Route::get('seo-pages/{page_name}/edit', [SeoPagesController::class, 'edit'])->name('admin.seo-pages.edit');
        Route::put('seo-pages/{page_name}', [SeoPagesController::class, 'update'])->name('admin.seo-pages.update');

        // Sitemap Route
        Route::get('/sitemap', SitemapController::class)->name('admin.sitemap');

        // Social media share buttons
        // Route::get('/social-share', [SocialShareController::class, 'index'])->name('admin.social-share');

    });
});


Route::get('/clear-cache', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('config:clear');
    return 'Cache cleared successfully';
});
