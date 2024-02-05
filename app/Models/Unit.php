<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    protected $table = 'selling_units';

    public function project()
    {
        return $this->belongsTo(SProject::class);
    }

    public function floor()
    {
        return $this->belongsTo(Floor::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function price()
    {
        return number_format(round((float)$this->price, 2));
    }

    public function getGalleryAttribute($value)
    {
        return json_decode($value);
    }

    public function getNameAttribute($value)
    {
        return json_decode($value);
    }

    public function getAccessoriesAttribute($value)
    {
        return json_decode($value);
    }

    public function getSpecificationsAttribute($value)
    {
        return json_decode($value);
    }
}
