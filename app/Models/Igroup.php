<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Igroup extends Model
{
    use HasFactory;

    public function getTitleAttribute($value)
    {
        return json_decode($value);
    }
}
