<?php

namespace App\Models;

use App\Traits\ScriptsTrait;
use App\Traits\SEOTool\SEOToolTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UniqueImages\ImageDetailsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory, ImageDetailsTrait, SEOToolTrait, ScriptsTrait;

    public $uniqueFiles = [
        'image' => [
            'formInputKey' => 'image',
            'validation'   => 'required|mimes:webp,svg,jpg,jpeg,png,gif|max:400',
        ],
    ];

    public $filesPath = 'events';

    public function getTitleAttribute($value)
    {
        return json_decode($value);
    }

    public function getGalleryAttribute($value)
    {
        return json_decode($value);
    }

}
