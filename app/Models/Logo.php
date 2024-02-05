<?php

namespace App\Models;

use App\Traits\UniqueImages\ImageDetailsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Logo extends Model
{
    use HasFactory, ImageDetailsTrait;

    public $uniqueFiles = [
        'image' => [
            'formInputKey' => 'image',
            'validation'   => 'required|mimes:webp,svg,jpg,jpeg,png,gif|max:400',
        ],
    ];

    public $filesPath = 'logos';


    public function getTitleAttribute($value)
    {
        return json_decode($value);
    }
}
