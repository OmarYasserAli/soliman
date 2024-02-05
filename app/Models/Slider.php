<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UniqueImages\ImageDetailsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Slider extends Model
{
    use HasFactory, ImageDetailsTrait;

    protected $table = 'slider';

    public $uniqueFiles = [
        'image' => [
            'formInputKey' => 'image',
            'validation'   => 'required|mimes:webp,svg,jpg,jpeg,png,gif|max:400',
        ],
    ];

    public $filesPath = 'slider';

    public function getTitleAttribute($value)
    {
        return json_decode($value);
    }
}
