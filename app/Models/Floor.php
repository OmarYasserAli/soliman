<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floor extends Model
{
    use HasFactory;
    protected $table = 'selling_floors';

    public function getNameAttribute($value)
    {
        return json_decode($value);
    }
}
