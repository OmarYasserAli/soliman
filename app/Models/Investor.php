<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Investor extends Model
{
    use HasFactory;

    public $filesPath = 'investors';

    public function getTitleAttribute($value)
    {
        return json_decode($value);
    }

    public function getParentNameAttribute($value)
    {
        return json_decode($value);
    }

    public function groups()
    {
        return $this->belongsTo(Igroup::class, 'group', 'id');
    }
}
