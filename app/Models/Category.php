<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['category_name', 'category_photo'];
    
    public function relationwithproduct(){
        return $this->hasOne(Product::class, 'id', 'product_category_id');
    }
}
