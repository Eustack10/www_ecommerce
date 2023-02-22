<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsVariants extends Model
{
    use HasFactory;
    protected $table = 'products_variants';
    protected $fillable = ['products_id', 'name', 'price'];
    protected $casts = ['price' => 'float'];
    function products(){
        return $this->belongsTo(Products::class, 'products_id', 'id');
    }
}
