<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'selling_cities';

    public function areas()
    {
        return $this->hasMany(Area::class);
    }

    public function getNameAttribute($value)
    {
        return json_decode($value);
    }
}
