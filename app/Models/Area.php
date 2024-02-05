<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = 'selling_areas';

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getNameAttribute($value)
    {
        return json_decode($value);
    }
}
