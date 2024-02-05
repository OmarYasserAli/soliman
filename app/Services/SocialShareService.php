<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;

class SocialShareService
{
    private $model;

    /**
     * Class Construct
     */
    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Render needed social media share links
     */
    public function render(string $shareTitle = '')
    {
        return \Share::currentPage($shareTitle)
        ->facebook()
        ->twitter()
        ->linkedin()
        ->telegram()
        ->whatsapp();
    }
}
