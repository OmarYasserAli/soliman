<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class SlugRedirectorService
{
    private $model;

    private $slug;

    private $routeName;

    public function __construct(Model $model, string $slug, string $routeName)
    {
        $this->model = $model;
        $this->slug = $slug;
        $this->routeName = $routeName;
    }

    public function rectify()
    {
        if(LaravelLocalization::getCurrentLocale() == 'en') {

            /**
             * If the slug doesn't contain english characters only
             * Get the english slug of the sent product's arabic slug then redirect to the same page but with the english slug
             * Otherwise continue the controller logic
             */
            if(preg_match('/[^A-Za-z0-9-]/', $this->slug)) return redirect()->route($this->routeName, $this->model->slug);

        } else {

            /**
             * If the slug contains english characters
             * Get the arabic slug of the sent product's english slug then redirect to the same page but with the arabic slug
             * Otherwise continue the controller logic
             */
            if(preg_match('/[A-Za-z0-9]/', $this->slug)) return redirect()->route($this->routeName, $this->model->slug_ar);
        }
    }
}
