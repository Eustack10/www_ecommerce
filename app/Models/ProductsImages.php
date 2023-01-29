<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsImages extends Model
{
    use HasFactory;
    protected $table = 'products_images';
    protected $fillable = ['products_id', 'url'];
    function products(){
        return $this->belongsTo(Products::class, 'products_id', 'id');
    }
}
