<?php

namespace App\Models;

use App\Traits\SEOTool\SEOToolTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Page extends Model
{
    use HasFactory, SEOToolTrait;

    protected $table='pages';

    public $filesPath = 'pages';

    public function getTitleAttribute($value)
    {
        return json_decode($value);
    }

    public function getContentAttribute($value)
    {
        return json_decode($value);
    }
}
