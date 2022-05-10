<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['product_thumbnail_photo'];

    public function relationwithcategory(){
        return $this->hasOne(Category::class, 'id', 'product_category_id');
    }
    public function relationwithsubcategory(){
        return $this->hasOne(Subcategory::class, 'id', 'product_subcategory_id');
    }
}



