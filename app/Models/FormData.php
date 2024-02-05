<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    use HasFactory;
    protected $table = 'form_data' ;
    protected $fillable =["name", "phone" , "email", "product_id","form_id"];


    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
