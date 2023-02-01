<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['name', 'description', 'brand', 'is_publish', 'categories_id'];
    
    function categories(){
        return $this->belongsTo(Categories::class, 'categories_id', 'id');
    }

    function products_images(){
        return $this->hasMany(ProductsImages::class, 'products_id', 'id');
    }
    function products_variants(){
        return $this->hasMany(ProductsVariants::class, 'products_id', 'id');
    }
}
