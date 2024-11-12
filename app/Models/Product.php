<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'stock',
        'price',
        'brand_id',
    ];


    //relacion con la tabla brands
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


        public function images()
    {
        return $this->hasMany(Image::class);
    }


}
