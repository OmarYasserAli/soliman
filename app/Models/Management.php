<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UniqueImages\ImageDetailsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Management extends Model
{
    use HasFactory, ImageDetailsTrait;

    protected $table = 'managements';

    public $uniqueFiles = [
        'image' => [
            'formInputKey' => 'image',
            'validation'   => 'required|mimes:webp,svg,jpg,jpeg,png,gif|max:400',
        ],
    ];

    public $filesPath = 'management';

    public function getPtitleAttribute($value)
    {
        return json_decode($value);
    }

    public function getTitleAttribute($value)
    {
        return json_decode($value);
    }

    public function getNameAttribute($value)
    {
        return json_decode($value);
    }
}
