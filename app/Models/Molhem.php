<?php

namespace App\Models;

use App\Traits\ScriptsTrait;
use App\Traits\SEOTool\SEOToolTrait;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UniqueImages\ImageDetailsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Molhem extends Model
{
    use HasFactory, ImageDetailsTrait, SEOToolTrait, ScriptsTrait;

    protected $table = 'molhem';

    public $uniqueFiles = [
        'image' => [
            'formInputKey' => 'image',
            'validation'   => 'required|mimes:webp,svg,jpg,jpeg,png,gif|max:400',
        ],
    ];

    public $filesPath = 'molhem';

    public function getTitleAttribute($value)
    {
        return json_decode($value);
    }

    public function getCatAttribute($value)
    {
        return json_decode($value);
    }

    public function getBreifAttribute($value)
    {
        return json_decode($value);
    }

    public function getContentAttribute($value)
    {
        return json_decode($value);
    }
}
