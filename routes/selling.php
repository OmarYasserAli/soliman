<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Selling\HomeController;
use App\Http\Controllers\Selling\MainController;
use App\Http\Controllers\Selling\AreasController;
use App\Http\Controllers\Selling\LeadsController;
use App\Http\Controllers\Selling\LoginController;
use App\Http\Controllers\Selling\SpecsController;
use App\Http\Controllers\Selling\TypesController;
use App\Http\Controllers\Selling\UnitsController;
use App\Http\Controllers\Selling\CitiesController;
use App\Http\Controllers\Selling\FloorsController;
use App\Http\Controllers\Selling\SellerController;
use App\Http\Controllers\Selling\ProjectsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect']
], function()
{
    Route::prefix('selling')->group(function () {
        Route::get('/', [MainController::class, 'home'])->name('selling.home');
        Route::get('project/{slug}', [MainController::class, 'project'])->name('selling.project');
        Route::get('city/{slug}', [MainController::class, 'city'])->name('selling.city');
        Route::get('area/{slug}', [MainController::class, 'area'])->name('selling.area');
        Route::post('projects-load', [MainController::class, 'projectsLoad'])->name('selling.projects.load');
        Route::post('project-load', [MainController::class, 'projectLoad'])->name('selling.project.load');
        Route::post('unit-request', [MainController::class, 'unitRequest'])->name('selling.unit.request');
    });
});



Route::middleware(['auth', 'dlang'])
->prefix('selling-admin')
->group(function () {
    Route::get('/', [HomeController::class, 'home'])->name('selling.admin');
    Route::get('setting', [HomeController::class, 'setting'])->name('selling.setting');
    Route::post('setting', [HomeController::class, 'settingPost'])->name('selling.psetting');
    Route::get('leads', [LeadsController::class, 'index'])->name('selling.leads');
    Route::get('leads/export', [LeadsController::class, 'export'])->name('selling.leads.export');

    Route::resource('sprojects', ProjectsController::class);
    Route::get('sprojects/replicate/{id}', [ProjectsController::class, 'replicate'])->name('sprojects.replicate');

    Route::get('units/replicate/{id}', [UnitsController::class, 'replicate'])->name('units.replicate');
    Route::get('units/replicate10/{id}', [UnitsController::class, 'replicate10'])->name('units.replicate10');
    Route::resource('units', UnitsController::class);
    Route::get('types/list', [TypesController::class, 'TypesList'])->name('types.list');
    Route::resource('types', TypesController::class);
    Route::resource('floors', FloorsController::class);
    Route::resource('specs', SpecsController::class);
    Route::resource('cities', CitiesController::class);
    Route::get('areas/list', [AreasController::class, 'AreasList'])->name('areas.list');
    Route::resource('areas', AreasController::class);
    Route::resource('sellers', SellerController::class);

});

Route::middleware(['seller.guest', 'dlang'])
->prefix('selling-seller')
->group(function () {
    Route::get('login', [LoginController::class, 'loginForm'])->name('seller.login.form');
    Route::post('login', [LoginController::class, 'login'])->name('seller.login');

});

Route::middleware(['seller'])
->prefix('selling-seller')
->group(function () {
    Route::post('unit-update', [UnitsController::class, 'unitUpdate'])->name('seller.unit.update');

});

