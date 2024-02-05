<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SProject extends Model
{
    use HasFactory;
    protected $table = 'selling_projects';

    public function getGalleryAttribute($value)
    {
        return json_decode($value);
    }

    public function getIgalleryAttribute($value)
    {
        return json_decode($value);
    }

    public function types()
    {
        return $this->hasMany(Type::class);
    }

    public function units()
    {
        return $this->hasMany(Unit::class, 'project_id');
    }

    public function avUnits()
    {
        //dump($this->units()->where('status', 0)->get());
        return $this->units()->where('status', 0)->count();
    }

    public function allUnits()
    {
        return $this->units()->count();
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function cover()
    {
        return $this->cover ? url('uploads/sprojects/'.$this->cover) : null;
    }

    public function getNameAttribute($value)
    {
        return json_decode($value);
    }
}
