<?php

namespace App\Models;

use App\Traits\SEOTool\SEOToolTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UniqueImages\ImageDetailsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory, ImageDetailsTrait, SEOToolTrait;

    protected $table='news';

    public $uniqueFiles = [
        'image' => [
            'formInputKey' => 'image',
            'validation'   => 'required|mimes:webp,svg,jpg,jpeg,png,gif|max:400',
        ],
    ];

    public $filesPath = 'news';

    public function getTitleAttribute($value)
    {
        return json_decode($value);
    }

    public function getContentAttribute($value)
    {
        return json_decode($value);
    }
}
