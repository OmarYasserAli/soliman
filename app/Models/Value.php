<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UniqueImages\ImageDetailsTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Value extends Model
{
    use HasFactory, ImageDetailsTrait;

    public $uniqueFiles = [
        'image' => [
            'formInputKey' => 'image',
            'validation'   => 'required|mimes:webp,svg,jpg,jpeg,png,gif|max:400',
        ],
    ];

    public $filesPath = 'values';

    public function getTitleAttribute($value)
    {
        return json_decode($value);
    }

    public function getBreifAttribute($value)
    {
        return json_decode($value);
    }
}
