<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $table = 'selling_types';

    public function getGalleryAttribute($value)
    {
        return json_decode($value);
    }

    public function project()
    {
        return $this->belongsTo(SProject::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class)->with(['floor']);
    }

    public function getNameAttribute($value)
    {
        return json_decode($value);
    }
}
